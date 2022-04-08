<?php


use Illuminate\Support\Facades\Route;

use \App\Http\Controllers\HomeController;
use \App\Http\Controllers\ProfilesController;
use \App\Http\Controllers\PostsController;
use \App\Http\Controllers\FollowsController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// AUTH
Auth::routes();

// Route::get('/home', [HomeController::class, 'index'])->name('home');

// PROFILE
Route::get('/profile/{user}', [ProfilesController::class, 'index'])->name('profile.show');
Route::get('/profile/{user}/edit', [ProfilesController::class, 'edit'])->name('profile.edit');
Route::patch('/profile/{user}', [ProfilesController::class, 'update'])->name('profile.update');


// POST

Route::resource('/post', PostsController::class);
Route::get('/', [PostsController::class, 'index']);

// FOLLOW
Route::post('/follow/{user}', [FollowsController::class, 'store']);