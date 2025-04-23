<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\homeController\IndexController;
//admin Controller
use App\Http\Controllers\adminController\CategoryController;
use App\Http\Controllers\adminController\GenreController;
use App\Http\Controllers\adminController\CountryController;
use App\Http\Controllers\adminController\MovieController;
use App\Http\Controllers\adminController\SeasonController;
use App\Http\Controllers\adminController\EpisodeController;
use App\Http\Controllers\adminController\AdminController;
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

Route::get('/', [IndexController::class, 'index'])->name('home-user');
Route::get('/danh-muc/{slug}', [IndexController::class, 'category'])->name('category');
Route::get('/the-loai/{slug}', [IndexController::class, 'genre'])->name('genre');
Route::get('/quoc-gia/{slug}', [IndexController::class, 'country'])->name('country');
Route::get('/phim', [IndexController::class, 'movie'])->name('movie');
Route::get('/xem-phim', [IndexController::class, 'watch'])->name('watch');
Route::get('/tap-phim', [IndexController::class, 'episode'])->name('episode');

Auth::routes();

//admin routes
Route::prefix('admin')->middleware('checkAdmin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index')->middleware('checkAdmin');
    Route::resource('categories', CategoryController::class)->middleware('checkAdmin');
    Route::resource('genres', GenreController::class)->middleware('checkAdmin');
    Route::resource('countries', CountryController::class)->middleware('checkAdmin');
    Route::resource('movies', MovieController::class)->middleware('checkAdmin');
    Route::resource('seasons', SeasonController::class)->middleware('checkAdmin');
    Route::resource('episodes', EpisodeController::class)->middleware('checkAdmin');
});
