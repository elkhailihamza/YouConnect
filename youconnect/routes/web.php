<?php

use App\Http\Controllers\AuthController;
<<<<<<< HEAD
use App\Http\Controllers\HomeController;
=======
use App\Http\Controllers\PostController;
>>>>>>> ccb2c59d6360bf5fa9c671cad76a5c6dad9bb6a2
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

<<<<<<< HEAD
Route::get('/',[HomeController::class, 'index'])->name('index');
Route::get('/home',[HomeController::class, 'index'])->name('index');
=======
Route::get('/', function () {
    return view('main.index');
})->name('index');
>>>>>>> ccb2c59d6360bf5fa9c671cad76a5c6dad9bb6a2

Route::get('/explore', function () {
    return view('explore');
})->name('explore');

Route::middleware(['auth'])->group(function () {
    Route::controller(PostController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/posts/{post}/view', 'view')->name('main.posts.view');
        Route::get('/posts/create', 'create')->name('main.posts');
        Route::post('/posts/create/store', 'store')->name('main.posts.store');
    });
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/register', 'showRegister')->name('register');
    Route::post('/register', 'register');
    Route::get('/login', 'showLogin')->name('login');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout')->middleware(['auth'])->name('logout');
});