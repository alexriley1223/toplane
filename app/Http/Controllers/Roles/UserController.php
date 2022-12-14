<?php

namespace App\Http\Controllers\Roles;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

use Hash;

use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\ProfileModules\Summoner;

class UserController extends Controller
{
    public function editShow()
    {
      $summoners = Summoner::where('user_id', Auth::id())->get();
      return view('user.edit', ['summoners' => $summoners]);
    }

    public function editLogin(Request $request)
    {
      $request->validate([
        'password'  =>  ['nullable', 'confirmed', Password::min(8)->mixedCase()->numbers()]
      ]);

      // Update password
      if($request->password) {
        // As more options become available, move this out
        $user = User::where('id', Auth::id())->first();
        $user->update([
          'password' => Hash::make($request->password)
        ]);
      }

      return redirect()->route('user.edit')->with('success', 'Updated successfully');
    }

    public function editProfile(Request $request)
    {
      $request->validate([
        'profile_picture' =>  'nullable|file|image|max:1024',
      ]);

      // Change Profile Picture
      if($request->profile_picture) {
        $user = User::where('id', Auth::id())->first();
        $oldpath = $user->picture_url;
        $path = $request->file('profile_picture')->store('images/avatars');
        $user->picture_url = $path;

        if($user->getOriginal('picture_url') != 'images/avatars/profile.png')
        {
          Storage::disk('public')->delete($oldpath);
        }
      }

      $user->save();

      return redirect()->route('user.edit')->with('success', 'Updated successfully');
    }
}
