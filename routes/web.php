<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;


Route::get('/', [AuthController::class, 'login'])->name('login');
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

Route::post('/posts/{id}/like', [PostController::class, 'like'])
    ->name('posts.like');



Route::post('/posts/{post}/comment', [PostController::class, 'storecomments'])
    ->name('comments.store');





Route::post('/comments/{comment}/like', [PostController::class,'likecomment'])
    ->name('comments.like');

use App\Http\Controllers\CommunityController;

Route::post('/communities/store', [CommunityController::class, 'store'])
    ->name('communities.store');
use App\Http\Controllers\ProfileController;

Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

Route::delete('/community/{id}', [ProfileController::class, 'deleteCommunity'])
    ->name('community.delete');


    use App\Http\Controllers\CommunityJoinController;

Route::post('/community/{id}/join', [CommunityJoinController::class, 'sendRequest'])
    ->name('community.join');

Route::post('/community-request/{id}/approve', [CommunityJoinController::class, 'approve'])
    ->name('community.request.approve');

Route::post('/community-request/{id}/reject', [CommunityJoinController::class, 'reject'])
    ->name('community.request.reject');
    
Route::get('/community/{communityId}/posts', [CommunityController::class, 'show'])->name('community.posts');
