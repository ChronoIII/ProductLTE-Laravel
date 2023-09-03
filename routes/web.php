<?php

use Illuminate\Support\Facades\Route;

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

Route::middleware('guest')->group(function() {
    Route::get('/login', function () {
        return view('auth');
    })->name('login');

    Route::get('/register', function () {
        return view('auth');
    });
});

Route::middleware([])->group(function() {
    Route::get('/', function () {
        return view('app');
    });

    Route::get('/home', function () {
        return view('app');
    });

    Route::get('/product/add', function () {
        return view('app');
    });

    Route::get('/product/update/{id}', function () {
        return view('app');
    });

    Route::get('/category', function () {
        return view('app');
    });

    Route::get('/video-player', function () {
        return view('app');
    });
});
