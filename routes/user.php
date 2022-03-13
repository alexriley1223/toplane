<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Roles\UserController;

use App\Models\User;

Route::prefix('profile')->group(function() {

  // Show Edit View
  Route::get('/edit', [UserController::class, 'editShow'])->middleware('auth')->name('user.edit');

  // Edit Login information
  Route::post('/edit/login', [UserController::class, 'editLogin'])->middleware(['auth','web'])->name('user.edit.login');

  // Edit Forum information
  Route::post('/edit/forum', [UserController::class, 'editForum'])->middleware(['auth','web'])->name('user.edit.forum');

  // Edit Profile information
  Route::post('/edit/profile', [UserController::class, 'editProfile'])->middleware(['auth','web'])->name('user.edit.profile');

  // Generic Profile Show
  Route::get('/{name}', function($name){
    $profile = User::where('name', $name)->where('deleted_at', null)->get()->first();

    if($profile) {
      return view('user.index', [ 'user' => $profile ]);
    } else {
      abort(404);
    }
  });
});
