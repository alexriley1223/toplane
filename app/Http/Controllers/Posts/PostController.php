<?php

namespace App\Http\Controllers\Posts;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Auth;

use App\Models\Post;
use App\Models\PostIdentity;

use App\Http\Controllers\Controller;

use ForumHelper;

class PostController extends Controller
{
    public function create(Request $request) {

      // Verify within rate limit
      if (RateLimiter::tooManyAttempts('create-post:'.Auth::id(), $perMinute = 1)) {
        $seconds = RateLimiter::availableIn('create-post:'.Auth::id());
        return 'You may try again in '.$seconds.' seconds.';
      }

      // Validate request
      $request->validate([
        'title'         =>  'required',
        'identity'      =>  'required',
        'content'       =>  'required',
      ]);

      // Check PostIdentity
      // Doing this so new posts are tied to the forum they were clicked on

      $postIdentity = PostIdentity::where('identity', $request->identity)->first();

      if($postIdentity) {
        if($postIdentity->user_id != Auth::id()) {
          return 'Invalid Reply. Please Try Again.';
        }
      } else {
        return 'Invalid Post. Please Try Again.';
      }

      // Create new post
      $post = new Post;

      $post->title     = $request->title;
      $post->user_id   = Auth::id();
      $post->forum_id  = $postIdentity->forum_id;
      $post->content   = $request->content;
      $post->slug      = ForumHelper::generateSlug(Post::class, $request->title, 1);

      $post->save();

      RateLimiter::hit('create-post:'.Auth::id());

      return redirect()->to('post/'.$post->slug);
    }
}
