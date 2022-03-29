<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Roles\UserController;
use App\Http\Controllers\Auth\SummonerController;

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

  // Add new summoner
  Route::post('/edit/summoner/create', [SummonerController::class, 'create'])->middleware(['auth','web'])->name('user.summoner.create');

  // Validate an existing summoner
  Route::post('/edit/summoner/validate', [SummonerController::class, 'validateSummoner'])->middleware(['auth','web'])->name('user.summoner.validate');

  // Destroy summoner entry
  Route::post('/edit/summoner/destroy', [SummonerController::class, 'destroy'])->middleware(['auth','web'])->name('user.summoner.destroy');

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
