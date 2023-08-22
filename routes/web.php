<?php

use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [MovieController::class, 'index'])->name('movies.index');

Route::get('/movies/{movie}', [MovieController::class, 'show'])
    ->name('movies.show');

Route::get('/actors', [\App\Http\Controllers\ActorController::class, 'index'])->name('actors.index');
Route::get('/actors/page/{page?}', [\App\Http\Controllers\ActorController::class, 'index']);
Route::get('/actors/{actor}', [\App\Http\Controllers\ActorController::class, 'show'])->name('actors.show');
