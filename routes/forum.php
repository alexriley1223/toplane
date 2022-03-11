<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

use App\Models\Category;
use App\Models\Forum;

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

});

// Base 'All Categories' view
Route::get('/forum', function(){
  return view('pages.forum.forum', ['categories' => Category::orderBy('order')->where('deleted_at', null)->get()]);
});
