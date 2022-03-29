<?php
namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Http;

use App\Models\Summoner;

class SummonerController extends Controller
{
    public function create(Request $request)
    {
      $request->validate([
        'summoner'  =>  ['required'],
        'region'    =>  ['required', Rule::in(['NA1', 'BR1', 'EUN1', 'EUW1', 'LA1', 'LA2', 'OC1', 'RU', 'TR1'])],
      ]);

      // Check if account already has a summoner in the region
      $existingSummoner = Summoner::where('user_id', Auth::id())->where('region', $request->region)->first();
      if($existingSummoner) {
        return 'You already have a summoner registered in that region!';
      }

      // Check if account already exists, validated with someone else
      $existingValidated = Summoner::where('summoner_name', $request->summoner)->where('region', $request->region)->first();
      if($existingValidated) {
        if($existingValidated->validated) {
          return 'Summoner name in that region is already validated.';
        }
      }

      $summoner = new Summoner;

      $summoner->user_id        = Auth::id();
      $summoner->summoner_name  = $request->summoner;
      $summoner->region         = $request->region;
      $summoner->validated       = false;

      $summoner->save();

      return redirect()->back();
    }

    public function validateSummoner(Request $request)
    {
      if (RateLimiter::tooManyAttempts('validate-summoner:'.Auth::id(), $perMinute = 1)) {
        $seconds = RateLimiter::availableIn('validate-summoner:'.Auth::id());
        return 'You may try again in '.$seconds.' seconds.';
      }

      $request->validate([
        'summoner'  =>  ['required'],
        'region'    =>  ['required', Rule::in(['NA1', 'BR1', 'EUN1', 'EUW1', 'LA1', 'LA2', 'OC1', 'RU', 'TR1'])],
      ]);

      $existingSummoner = Summoner::where('user_id', Auth::id())->where('summoner_name', $request->summoner)->where('region', $request->region)->first();
      if(!$existingSummoner) {
        return 'Error validating summoner. Please try again.';
      }

      $response = Http::get('https://'.$existingSummoner->region.'.api.riotgames.com/lol/summoner/v4/summoners/by-name/' . $existingSummoner->summoner_name, [
        'api_key' => env('LEAGUE_API_KEY')
      ]);

      if($response->status() != 200) {
        RateLimiter::hit('validate-summoner:'.Auth::id());
        return 'Error validating summoner. Please try again.';
      }

      $summonerData = $response->json();

      // Check icon validation
      if($summonerData['profileIconId'] != 2) {
        RateLimiter::hit('validate-summoner:'.Auth::id());
        return 'Error validating summoner. Please use the correct icon!';
      }

      $existingSummoner->validated = 1;
      $existingSummoner->save();

      RateLimiter::hit('validate-summoner:'.Auth::id());

      return redirect()->back();
    }

    public function destroy(Request $request)
    {
      $request->validate([
        'summoner'  =>  ['required'],
        'region'    =>  ['required', Rule::in(['NA1', 'BR1', 'EUN1', 'EUW1', 'LA1', 'LA2', 'OC1', 'RU', 'TR1'])],
      ]);

      $existingSummoner = Summoner::where('user_id', Auth::id())->where('summoner_name', $request->summoner)->where('region', $request->region)->first();
      if(!$existingSummoner) {
        return 'Error removing summoner from account. Please try again.';
      } else {
        $existingSummoner->delete();
      }

      return redirect()->back();
    }
}
