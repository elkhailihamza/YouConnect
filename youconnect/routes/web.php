<?php
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FriendshipController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Models\Post;
use Symfony\Component\HttpFoundation\RequestMatcher\HostRequestMatcher;

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

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/home', 'index')->name('index');
    Route::get('/users/get', 'getUsers');
});

Route::controller(CommentController::class)->group(function () {
    Route::get('/posts/{post}/comments', 'index');
    Route::get('/posts/{post}/comments/count', 'count');
    Route::post('/posts/{post}/comments/store', 'store')->middleware(['auth']);
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
    Route::get('/sendrequest/{friend}', [FriendshipController::class, 'sendRequest'])->name('sendRequest');
    Route::get('/received-requests', [FriendshipController::class, 'receivedRequests'])->name('received-requests');
    Route::post('/accept-request/{friendship}', [FriendshipController::class, 'acceptRequest'])->name('accept-request');
    Route::post('/reject-request/{friendship}', [FriendshipController::class, 'rejectRequest'])->name('reject-request');
    Route::delete('/cancel-request/{friendship}', [FriendshipController::class, 'cancelRequest'])->name('cancelRequest');
    
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile/{user}', 'showuser')->name('profiles.profile');
        Route::get('/profile/edit', 'edituser')->name('profiles.edit');
        Route::put('/profile/{user}', 'updateuser')->name('profiles.update');
        Route::get('/user/{user}/posts', 'showUserPosts')->name('profiles.Myposts');
    });
    Route::controller(PostController::class)->group(function () {
        Route::post('/posts/create/store', 'store')->name('main.posts.store');
        Route::get('/posts/{post}/edit', 'updatePost')->name('posts.update');
        Route::put('/posts/{post}', 'update')->name('posts.storeUpdate');
        Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

    });
    Route::controller(LikeController::class)->group(function () {
        Route::post('/like/toggle', 'toggleLike')->name('like.toggle');
        Route::post('/posts/{post}/like', 'store')->name('posts.like');
        Route::delete('/posts/{post}/like', 'destroy')->name('posts.unlike');
        Route::get('/posts/{post}/check-like', 'checkLike')->name('posts.check-like');
    });
});