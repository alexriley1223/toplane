<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

/* Auth Routes */
Route::prefix('auth')->group(function() {
  Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
  Route::post('/login', [AuthController::class, 'authenticate'])->name('auth.authenticate')->middleware('web');
  Route::get('/register', [AuthController::class, 'registration'])->name('auth.registration');
  Route::post('/register', [AuthController::class, 'create'])->name('auth.create')->middleware('web');
  Route::get('/logout', [AuthController::class, 'logout'])->name('auth.signout');
});
