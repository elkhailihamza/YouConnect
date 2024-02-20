<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/',[HomeController::class, 'index'])->name('index');
Route::get('/home',[HomeController::class, 'index'])->name('index');

Route::get('/explore', function () {
    return view('explore');
})->name('explore');

Route::middleware(['auth'])->group(function () {
    Route::get('/posts/create', [PostController::class, 'create'])->name('main.posts');
    Route::post('/posts/create/store', [PostController::class, 'store'])->name('main.posts.store');
    
    Route::post('/posts/{id}/like', 'PostController@like')->name('posts.like');
Route::delete('/posts/{id}/like', 'PostController@unlike')->name('posts.unlike');

});

Route::group(['prefix' => 'auth'], function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware(['auth'])->name('logout');
});