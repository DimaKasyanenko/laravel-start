<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('home');

//Route::middleware('guest')->group(function () {
//    Route::get('/login', [AuthController::class, 'login'])->name('login');
//    Route::post('/login', [AuthController::class, 'authenticate'])->name('login');
//    Route::get('/register', [AuthController::class, 'register'])->name('register');
//    Route::post('/register', [AuthController::class, 'store'])->name('register');
//});



Route::middleware('auth')->group(function () {
//    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::resource('/articles', ArticleController::class)
         ->except(['show']);
});

