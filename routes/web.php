<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

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

// Authentication
Route::get('/', [ProfileController::class, 'getLogin'])->name('login');
Route::post('/login', [ProfileController::class, 'postLogin'])->name('post_login');
Route::get('/logout', [ProfileController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('/check_in', [ProfileController::class, 'getCheckIn'])->name('get_check_in');
Route::post('/check_in', [ProfileController::class, 'postCheckIn'])->name('post_check_in');

// Feed
Route::get('/feed', [ProfileController::class, 'getFeed'])->middleware('auth')->name('feed');

// Others
Route::get('/profile', [ProfileController::class, 'getProfile'])->middleware('auth')->name('get_profile');
Route::post('/profile/save', [ProfileController::class, 'saveProfile'])->middleware('auth')->name('save_profile');
Route::get('/profile/check_nationality', [ProfileController::class, 'checkNationality'])->middleware('auth')->name('check_nationality');