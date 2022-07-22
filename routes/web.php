<?php

use Illuminate\Support\Facades\Route;

/* Pages Routes (other than Forum) */

Route::get('/', function () {
    return view('pages.home');
})->name('pages.home');
