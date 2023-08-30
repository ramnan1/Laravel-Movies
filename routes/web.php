<?php

use App\Http\Controllers\ActorsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\TvController;

// Route::get('/', function () {
//     return view('index');
// });

Route::get('/', [MoviesController::class,'index'])->name('movie.index');
Route::get('/movie/{id}', [MoviesController::class,'show'])->name('movie.show');


Route::get('/tv', [TvController::class,'index'])->name('tv.index');
Route::get('/tv/{id}', [TvController::class,'show'])->name('tv.show');


Route::get('/actors', [ActorsController::class,'index'])->name('actors.index');
Route::get('/actors/page/{page}', [ActorsController::class,'index']);
Route::get('/actors/{id}', [ActorsController::class,'show'])->name('actors.show');
