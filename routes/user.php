<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

use App\Models\User;

Route::prefix('profile')->group(function() {
  Route::get('/{name}', function($name){
    $profile = User::where('name', $name)->where('deleted_at', null)->get()->first();

    if($profile) {
      return view('user.index', [ 'user' => $profile ]);
    } else {
      abort(404);
    }
  });
});
