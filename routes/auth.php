<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

/* Auth Routes */
Route::prefix('auth')->group(function() {

  Route::get('/login', [AuthController::class, 'login'])->name('auth.login')->middleware('guest');
  Route::post('/login', [AuthController::class, 'authenticate'])->name('auth.authenticate')->middleware(['web', 'guest']);

  Route::get('/register', [AuthController::class, 'registration'])->name('auth.registration')->middleware('guest');
  Route::post('/register', [AuthController::class, 'create'])->name('auth.create')->middleware(['web', 'guest']);

  Route::get('/logout', [AuthController::class, 'logout'])->name('auth.signout')->middleware('auth');

  Route::get('/forgot', [AuthController::class, 'forgotView'])->name('auth.forgot.view')->middleware('guest');
  Route::post('/forgot', [AuthController::class, 'forgotPost'])->name('auth.forgot.post')->middleware(['web', 'guest']);

  Route::get('/reset-password/{token}', function ($token) {
    return view('auth.reset', ['token' => $token]);
  })->name('password.reset')->middleware('guest');

  Route::post('/reset-password', [AuthController::class, 'resetPost'])->name('password.update')->middleware('guest');
});
