<?php

use App\Http\Controllers\AuthController;
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

Route::get('/', function () {
    return view('main.index');
})->name('index');

Route::get('/explore', function () {
    return view('explore');
})->name('explore');
Route::controller(PostController::class)->group(function() {
    Route::get('/post/create', 'create')->name('main.post.create');
});

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');

Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

Route::post('/login', [AuthController::class, 'login']);