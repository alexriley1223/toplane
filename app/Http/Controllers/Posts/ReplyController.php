<?php

namespace App\Http\Controllers\Posts;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

use App\Models\Reply;
use App\Models\ReplyIdentity;
use App\Models\Post;

use App\Http\Controllers\Controller;

class ReplyController extends Controller
{
    public function create(Request $request) {

      if (RateLimiter::tooManyAttempts('create-reply:'.Auth::id(), $perMinute = 5)) {
        $seconds = RateLimiter::availableIn('create-reply:'.Auth::id());
        return 'You may try again in '.$seconds.' seconds.';
      }

      // Validate request
      $request->validate([
        'content'       =>  ['required'],
        'identity'      =>  ['required', Rule::exists('reply_identity')->where(function ($query) {
                              return $query->where('user_id', Auth::id());
                            })],
      ]);

      $replyIdentity = ReplyIdentity::where('identity', $request->identity)->first();

      // Create new post
      $reply = new Reply;

      $reply->user_id   = Auth::id();
      $reply->post_id   = $replyIdentity->post_id;
      $reply->content   = $request->content;

      $reply->save();

      RateLimiter::hit('create-reply:'.Auth::id());

      $replyIdentity->delete();

      // TO DO - direct to calculated pagination of reply
      return redirect()->to('post/'.Post::where('id', $replyIdentity->post_id)->first()->slug);
    }
}
