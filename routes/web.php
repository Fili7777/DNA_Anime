<?php

use App\Http\Controllers\AnimeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\MangaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome')->middleware('auth');

Route::get('/anime', [AnimeController::class, 'show_anime'])->name('anime');
Route::get('/anime/{id}/details', [AnimeController::class, 'show_anime_details'] )->name('anime_details');

Route::get('/manga', [MangaController::class, 'show_manga'])->name('manga');

//SOlo i guest possono accedere perchè: ->middleware('guest');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('registerForm')->middleware('guest');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('loginForm')->middleware('guest');

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/favourite', [FavouriteController::class, 'show_favourite'])->name('favourite')->middleware('auth');
