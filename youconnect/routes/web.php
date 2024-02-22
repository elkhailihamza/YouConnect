<?php
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FriendshipController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;



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
    Route::post('/posts/{post}/comments/store', 'store')->middleware(['auth'])->name('logout');
});

Route::group(['prefix' => 'auth'], function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('/register', 'showRegister')->name('register');
        Route::post('/register', 'register');
        Route::get('/login', 'showLogin')->name('login');
        Route::post('/login', 'login');
        Route::post('/logout', 'logout')->middleware(['auth'])->name('logout');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::controller(FriendshipController::class)->group(function () {
        Route::get('/send-request/{friend}', 'sendRequest')->name('sendRequest');
        Route::put('/friendship/{friendship}/accept', 'acceptRequest')->name('friendship.acceptRequest');
        Route::put('/friendship/{friendship}/reject', 'rejectRequest')->name('friendship.rejectRequest');
        Route::delete('/cancel-request/{friendship}', 'cancelRequest')->name('cancelRequest');
    });
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile/{user}', 'show')->name('profiles.profile');
        Route::get('/profile/edit', 'edit')->name('profiles.edit');
        Route::put('/profile/{user}', 'update')->name('profiles.update');
        Route::get('/user/{user}/posts', 'showUserPosts')->name('profiles.Myposts');
    });
    Route::controller(PostController::class)->group(function () {
        Route::get('/posts/create', 'createPost')->name('main.posts');
        Route::post('/posts/create/store', 'store')->name('main.posts.store');
    });
    Route::controller(LikeController::class)->group(function () {
        Route::post('/like/toggle', 'toggleLike')->name('like.toggle');
        Route::post('/posts/{post}/like', 'store')->name('posts.like');
        Route::delete('/posts/{post}/like', 'destroy')->name('posts.unlike');
        Route::get('/posts/{post}/check-like', 'checkLike')->name('posts.check-like');
    });
});