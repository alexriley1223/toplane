<?php

namespace App\Http\Controllers\Posts;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

use App\Models\Post;

use App\Http\Controllers\Controller;

use ForumHelper;

class PostController extends Controller
{
    public function create(Request $request) {

      if (RateLimiter::tooManyAttempts('create-post:'.Auth::id(), $perMinute = 1)) {
        $seconds = RateLimiter::availableIn('create-post:'.Auth::id());
        // TODO: Proper Response
        return 'You may try again in '.$seconds.' seconds.';
      }

      // Validate request
      // TO DO: implement character limits
      $request->validate([
        'title'         =>  ['required', 'string'],
        'content'       =>  ['required', 'string'],
      ]);

      if(!session()->exists('post')) {
        // TODO: Proper Response
        return 'Invalid post';
      }

      // Create new post
      $post = new Post;

      $forumId = session()->pull('post');

      $post->title     = $request->title;
      $post->user_id   = Auth::id();
      $post->forum_id  = $forumId;
      $post->content   = $request->content;
      $post->slug      = ForumHelper::generateSlug(Post::class, $request->title, 1);

      $post->save();

      RateLimiter::hit('create-post:'.Auth::id());

      return redirect()->to('post/'.$post->slug);
    }
}
