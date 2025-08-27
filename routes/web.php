<?php

use App\Http\Controllers\{PostController, TagController, UserController};
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\ {
    CanManagePosts,
    CanManageTags,
};
use Illuminate\Support\Facades\Route;

Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');

    Route::middleware([CanManageTags::class])->prefix('tags')->group(function () {
        Route::get('/', [TagController::class, 'all'])->name('tags.all');
        Route::post('/create', [TagController::class, 'create'])->name('tags.create');
        Route::delete('/{tag}', [TagController::class, 'delete'])->name('tags.delete');
    });

    Route::prefix('posts')->group(function () {
        Route::get('/my', [PostController::class, 'myPosts'])->name('posts.my');
        Route::get( '/add', [PostController::class, 'addPost'])->name('posts.add');
        Route::post( '/create', [PostController::class, 'create'])->name('posts.create');
        Route::post('/statusChange', [PostController::class, 'statusChange'])->name('posts.statusChange');
        Route::middleware([CanManagePosts::class])->group(function () {
            Route::match(['get', 'post'], '/requests', [PostController::class, 'requests'])->name('posts.requests');
        });
    });

});

require __DIR__ . '/auth.php';
