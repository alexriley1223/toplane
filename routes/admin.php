<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

use App\Http\Controllers\Roles\AdminController;
use App\Http\Controllers\Roles\ModeratorController;

use App\Http\Controllers\Posts\CategoryController;
use App\Http\Controllers\Posts\ForumController;

use App\Models\Post;
use App\Models\Reply;

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


  // Okay lot to do here:
  // 1. Move to proper controller - most likely Posts
  // 2. Split to appropriate middleware, should mods be able to do this too?

  /* Admin Maintenance for Posts */
  Route::prefix('post')->group(function(){
    // Lock / Unlock
    Route::get('/lock/{id}', function($id) {
      $post = Post::withTrashed()->where('id', $id)->first();

      if($post) {
        $post->locked = true;
        $post->save();
        return redirect()->back();
      } else {
        abort(404);
      }
    });
    Route::get('/unlock/{id}', function($id) {
      $post = Post::withTrashed()->where('id', $id)->where('locked', true)->first();

      if($post) {
        $post->locked = false;
        $post->save();
        return redirect()->back();
      } else {
        abort(404);
      }
    });

    // Sticky / Unsticky
    Route::get('/sticky/{id}', function($id) {
      $post = Post::withTrashed()->where('id', $id)->first();

      if($post) {
        $post->sticky = true;
        $post->save();
        return redirect()->back();
      } else {
        abort(404);
      }
    });
    Route::get('/unsticky/{id}', function($id) {
      $post = Post::withTrashed()->where('id', $id)->where('sticky', true)->first();

      if($post) {
        $post->sticky = false;
        $post->save();
        return redirect()->back();
      } else {
        abort(404);
      }
    });

    // Archive (soft delete) / Unarchive (restore)
    Route::get('/archive/{id}', function($id) {
      $post = Post::where('id', $id)->where('deleted_at', null)->first();

      if($post) {
        $post->delete();
        return redirect()->back();
      } else {
        abort(404);
      }
    });
    Route::get('/unarchive/{id}', function($id) {
      $post = Post::onlyTrashed()->where('id', $id)->first();

      if($post) {
        $post->restore();
        return redirect()->back();
      } else {
        abort(404);
      }
    });
  });

  /* Admin Maintenance for Replies */
  Route::prefix('reply')->group(function(){
    // just delete for now, until I have a better way to archive using soft deletes
    Route::get('/delete/{id}', function($id) {
      $reply = Reply::where('id', $id)->first();

      if($reply) {
        $reply->forceDelete();
        return redirect()->back();
      } else {
        abort(404);
      }
    });
  });
});
