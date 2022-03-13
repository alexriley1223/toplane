<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

use App\Http\Controllers\Roles\AdminController;
use App\Http\Controllers\Roles\ModeratorController;

use App\Http\Controllers\Posts\CategoryController;
use App\Http\Controllers\Posts\ForumController;

use App\Models\Post;

/* Moderator Routes */
Route::middleware(['auth', 'auth.moderator'])->prefix('mod')->group(function() {
  Route::get('/dashboard', [ModeratorController::class, 'dashboard'])->name('moderator.dashboard');
});

/* Admin Routes */
Route::middleware(['auth', 'auth.admin'])->prefix('admin')->group(function() {
  Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

  /* Admin Maintenance for Categories */
  Route::prefix('category')->group(function(){
    Route::post('/create', [CategoryController::class, 'create'])->name('admin.category.create')->middleware('web');
  });

  /* Admin Maintenance for Forums */
  Route::prefix('forum')->group(function(){
    Route::post('/create', [ForumController::class, 'create'])->name('admin.forum.create')->middleware('web');
  });


  /* Admin Maintenance for Posts */
  Route::prefix('post')->group(function(){
    Route::get('/lock/{slug}', function($slug){
      $post = Post::withTrashed()->where('slug', $slug)->get()->first();

      if($post) {
        $post->locked = true;
        $post->save();
        return redirect('post/'.$post->slug);
      } else {
        abort(404);
      }
    });

    Route::get('/unlock/{slug}', function($slug){
      $post = Post::withTrashed()->where('slug', $slug)->where('locked', true)->get()->first();

      if($post) {
        $post->locked = false;
        $post->save();
        return redirect('post/'.$post->slug);
      } else {
        abort(404);
      }
    });

    Route::get('/sticky/{slug}', function($slug){
      $post = Post::withTrashed()->where('slug', $slug)->get()->first();

      if($post) {
        $post->sticky = true;
        $post->save();
        return redirect('post/'.$post->slug);
      } else {
        abort(404);
      }
    });

    Route::get('/unsticky/{slug}', function($slug){
      $post = Post::withTrashed()->where('slug', $slug)->where('sticky', true)->get()->first();

      if($post) {
        $post->sticky = false;
        $post->save();
        return redirect('post/'.$post->slug);
      } else {
        abort(404);
      }
    });

    Route::get('/archive/{slug}', function($slug){
      $post = Post::where('slug', $slug)->where('deleted_at', null)->get()->first();

      if($post) {
        $post->delete();
        return redirect('post/'.$post->slug);
      } else {
        abort(404);
      }
    });

    Route::get('/unarchive/{slug}', function($slug){
      $post = Post::onlyTrashed()->where('slug', $slug)->get()->first();

      if($post) {
        $post->restore();
        return redirect('post/'.$post->slug);
      } else {
        abort(404);
      }
    });
  });
});
