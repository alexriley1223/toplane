<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

use App\Http\Controllers\Roles\AdminController;
use App\Http\Controllers\Roles\ModeratorController;

use App\Http\Controllers\Posts\CategoryController;
use App\Http\Controllers\Posts\ForumController;

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
});
