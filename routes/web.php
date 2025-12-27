<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;


Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginSubmit'])->name('login.submit');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerSubmit'])->name('register.submit');
Route::middleware('check.login')->group(function () {

    Route::get('/dashboard', [AuthController::class, 'dashboard'])
        ->name('dashboard');

    Route::get('/posts/create', [PostController::class, 'create'])
        ->name('posts.create');

    Route::post('/posts/store', [PostController::class, 'store'])
        ->name('posts.store');

});
Route::post('/logout', function () {
    session()->flush();
    return redirect()->route('login')
        ->with('success', 'Logged out successfully');
})->name('logout');









   Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

Route::post('/posts/{id}/like', [PostController::class, 'like'])->name('posts.like');


Route::post('/posts/{post}/comment', [PostController::class, 'storecomments'])
    ->name('comments.store');





Route::post('/comments/{comment}/like', [PostController::class,'likecomment'])
    ->name('comments.like');


