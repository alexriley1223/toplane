<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('pages.home');
})->name('pages.home');

/* Auth Routes */
Route::prefix('auth')->group(function() {
  Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
  Route::post('/login', [AuthController::class, 'authenticate'])->name('auth.authenticate')->middleware('web');
  Route::get('/register', [AuthController::class, 'registration'])->name('auth.registration');
  Route::post('/register', [AuthController::class, 'create'])->name('auth.create')->middleware('web');
  Route::get('/logout', [AuthController::class, 'logout'])->name('auth.signout');
});


/* Moderator Routes */
Route::middleware(['auth', 'auth.moderator'])->prefix('mod')->group(function() {
  Route::get('/dashboard', function() {
      echo 'Mod';
  });
});

/* Admin Routes */
Route::middleware(['auth', 'auth.admin'])->prefix('admin')->group(function() {
  Route::get('/dashboard', function() {
      echo 'Admin';
  });
});
