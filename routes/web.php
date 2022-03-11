<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

/* Pages Routes (other than Forum) */

Route::get('/', function () {
    return view('pages.home');
})->name('pages.home');
