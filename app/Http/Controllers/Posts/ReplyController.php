<?php

namespace App\Http\Controllers\Posts;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

use App\Models\Reply;
use App\Models\Post;

use App\Http\Controllers\Controller;

class ReplyController extends Controller
{
    public function create(Request $request) {

      if (RateLimiter::tooManyAttempts('create-reply:'.Auth::id(), $perMinute = 5)) {
        $seconds = RateLimiter::availableIn('create-reply:'.Auth::id());
        // TODO: Proper Response
        return 'You may try again in '.$seconds.' seconds.';
      }

      // Validate request
      $request->validate([
        'content'       =>  ['required'],
      ]);

      if(!session()->exists('reply')) {
        // TODO: Proper Response
        return 'Invalid reply';
      }

      // Create new post
      $reply = new Reply;

      $postId = session()->pull('reply');

      $reply->user_id   = Auth::id();
      $reply->post_id   = $postId;
      $reply->content   = $request->content;

      $reply->save();

      RateLimiter::hit('create-reply:'.Auth::id());

      // TO DO - direct to calculated pagination of reply
      return redirect()->to('post/'.Post::where('id', $postId)->first()->slug);
    }
}
