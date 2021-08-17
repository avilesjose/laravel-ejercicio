<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\PostController;
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
Route::get('/check_in', [ProfileController::class, 'getCheckIn'])->name('get_check_in');
Route::post('/check_in', [ProfileController::class, 'postCheckIn'])->name('post_check_in');

// Group
Route::middleware('auth')->group(function () {

    // Logout
    Route::get('/logout', [ProfileController::class, 'logout'])->middleware('auth')->name('logout');
    
    // Feed
    Route::get('/feed', [ProfileController::class, 'getFeed'])->middleware('auth')->name('feed');

    // Resources
    Route::middleware(['role:publisher|admin'])->group(function () {
        Route::resources([
            '/posts' => PostController::class,
            '/posts.comments' => PostCommentsController::class,
        ]);
    });

    // Others
	Route::get('/profile', [ProfileController::class, 'getProfile'])->middleware('auth')->name('get_profile');
	Route::post('/profile/save', [ProfileController::class, 'saveProfile'])->middleware('auth')->name('save_profile');
	Route::get('/profile/check_nationality', [ProfileController::class, 'checkNationality'])->middleware('auth')->name('check_nationality');

});

