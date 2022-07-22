<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Models\Category;
use App\Models\Forum;
use App\Models\Post;

use App\Http\Controllers\Posts\PostController;
use App\Http\Controllers\Posts\ReplyController;

// Show forum with all posts
Route::get('/forum/{slug}', function($slug){
  $forum = Forum::where('slug', $slug)->where('deleted_at', null)->get()->first();

  if($forum) {
    return view('pages.forum.single-forum', [ 'forum' => $forum ]);
  } else {
    abort(404);
  }
});

// Same as 'All Categories' but only show the specified
Route::get('/category/{slug}', function($slug){
  $category = Category::where('slug', $slug)->where('deleted_at', null)->get()->first();

  if($category) {
    return view('pages.forum.category', [ 'category' => $category ]);
  } else {
    abort(404);
  }

});

// Individual post
Route::get('/post/{slug}', function($slug){
  $post = Post::withTrashed()->where('slug', $slug)->get()->first();

  if($post) {
    return view('pages.forum.post', [ 'post' => $post ]);
  } else {
    abort(404);
  }
});

// New Posts
Route::get('/new-post/{slug}', function($slug){
  $forum = Forum::where('slug', $slug)->where('deleted_at', null)->get()->first();

  if($forum) {

    // Generate session for post identity
    session([ 'post' => $forum->id ]);

    return view('pages.forum.new-post');
  } else {
    abort(404);
  }
})->middleware('auth');
Route::post('/create-post', [PostController::class, 'create'])->middleware(['web', 'auth'])->name('forum.post.create');

// New Replies
Route::get('/new-reply/{slug}', function($slug){
  $post = Post::where('slug', $slug)->where('locked', false)->get()->first();

  if($post) {

    // Generate session for reply identity
    session([ 'reply' => $post->id ]);

    return view('pages.forum.new-reply');
  } else {
    abort(404);
  }
})->middleware('auth');
Route::post('/create-reply', [ReplyController::class, 'create'])->middleware(['web', 'auth'])->name('forum.reply.create');

// Base 'All Categories' view
Route::get('/forum', function(){
  return view('pages.forum.forum', ['categories' => Category::orderBy('order')->where('deleted_at', null)->get()]);
})->name('forum');
