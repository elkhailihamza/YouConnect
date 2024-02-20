<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
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

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/home', [HomeController::class, 'index'])->name('index');

Route::controller(CommentController::class)->group(function () {
    Route::get('/posts/{post}/comments', 'index');
    Route::get('/posts/{post}/comments/count', 'count');
    Route::post('/posts/{post}/comments/store', 'store');
});

Route::get('/explore', function () {
    return view('explore');
})->name('explore');

Route::middleware(['auth'])->group(function () {
    Route::controller(PostController::class)->group(function () {
        Route::get('/posts/create', 'createPost')->name('main.posts');
        Route::post('/posts/create/store', 'store')->name('main.posts.store');
    });
    Route::post('/posts/like', [LikeController::class, 'store'])->name('post.like');
    Route::post('/posts/unlike', [LikeController::class, 'destroy'])->name('post.unlike');
    Route::post('/posts/check-like/{post}', [LikeController::class, 'checkLike'])->name('post.check.like');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/register', 'showRegister')->name('register');
    Route::post('/register', 'register');
    Route::get('/login', 'showLogin')->name('login');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout')->middleware(['auth'])->name('logout');
});