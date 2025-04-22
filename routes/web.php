<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController;
//admin Controller
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\SeasonController;
use App\Http\Controllers\EpisodeController;

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

Route::get('/', [IndexController::class, 'home'])->name('home-user');
Route::get('/danh-muc', [IndexController::class, 'category'])->name('category');
Route::get('/the-loai', [IndexController::class, 'genre'])->name('genre');
Route::get('/quoc-gia', [IndexController::class, 'country'])->name('country');
Route::get('/phim', [IndexController::class, 'movie'])->name('movie');
Route::get('/xem-phim', [IndexController::class, 'watch'])->name('watch');
Route::get('/tap-phim', [IndexController::class, 'episode'])->name('episode');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

//admin routes
Route::prefix('admin')->group(function () {
    Route::resource('categories', CategoryController::class)->middleware('category');
    Route::resource('genres', GenreController::class);
    Route::resource('countries', CountryController::class);
    Route::resource('movies', MovieController::class);
    Route::resource('seasons', SeasonController::class);
    Route::resource('episodes', EpisodeController::class);
});
