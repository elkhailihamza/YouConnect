<?php
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;


Route::get('/',[HomeController::class, 'index'])->name('index');
Route::get('/home',[HomeController::class, 'index'])->name('index');

Route::get('/explore', function () {
    return view('explore');
})->name('explore');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profiles.profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profiles.edit');
    Route::put('/profile/{user}', [ProfileController::class, 'update'])->name('profiles.update');
    Route::get('/posts/create', [PostController::class, 'createPost'])->name('main.posts');
    Route::post('/posts/create/store', [PostController::class, 'store'])->name('main.posts.store');
    Route::get('/user/{user}/posts', [PostController::class, 'showUserPosts'])->name('profiles.Myposts');

    

    Route::post('/like/toggle', [App\Http\Controllers\LikeController::class, 'toggleLike'])->name('like.toggle');

Route::post('/posts/{post}/like', 'LikeController@store')->name('posts.like');
Route::delete('/posts/{post}/like', 'LikeController@destroy')->name('posts.unlike');
Route::get('/posts/{post}/check-like', 'LikeController@checkLike')->name('posts.check-like');

});

Route::group(['prefix' => 'auth'], function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware(['auth'])->name('logout');
});