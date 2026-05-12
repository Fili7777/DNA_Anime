<?php

use App\Http\Controllers\AnimeController;
use App\Http\Controllers\MangaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/anime', [AnimeController::class, 'show_anime'])->name('anime');
Route::get('/anime/{id}/details', [AnimeController::class, 'show_anime_details'] )->name('anime_details');

Route::get('/manga', [MangaController::class, 'show_manga'])->name('manga');

