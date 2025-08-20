<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\PostController::class, 'index'])->name('home');
Route::get('/my-posts', [\App\Http\Controllers\PostController::class, 'myPosts'])->name('my-posts');
Route::match(['get', 'post'], '/add-post', [\App\Http\Controllers\PostController::class, 'addPost'])->name('add-post');
Route::match(['get', 'post'], '/requests', [\App\Http\Controllers\PostController::class, 'requests'])->name('requests');
Route::post('/statusChange', [\App\Http\Controllers\PostController::class, 'statusChange'])->name('post.statusChange');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
