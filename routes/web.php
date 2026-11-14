<?php

use App\Models\{
    Like,
    Post,
    Comment
};
use App\Http\Controllers\{
    PostController,
    TagController,
    UserController,
    LikeController,
    CommentController,
    ChatController,
    MessageController,
};
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostController::class, 'index'])->name('index');
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

Route::get('/changelog', function () {
    return view('changelog.index');
})->name('changelog');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('users')->middleware('can:viewAny,\App\Models\User')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::get('/{user}', [UserController::class, 'view'])->name('users.view');
        Route::post('/ban/{user}', [UserController::class, 'ban'])->name('users.ban');
        Route::post('/mute/{user}', [UserController::class, 'mute'])->name('users.mute');
    });

    Route::prefix('chats')->group(function () {
        Route::get('/', [ChatController::class, 'viewAny'])->name('chats.viewAny');
        Route::post('/create', [ChatController::class, 'create'])->name('chats.create');
        Route::post('/{chat}/message', [MessageController::class, 'create'])->name('chats.message');
        Route::get('/{chat}', [ChatController::class, 'view'])->name('chats.view');
    });

    Route::prefix('tags')->middleware('can:create,\App\Models\Tag')->group(function () {
        Route::get('/', [TagController::class, 'all'])->name('tags.all');
        Route::post('/create', [TagController::class, 'create'])->name('tags.create');
        Route::delete('/{tag}', [TagController::class, 'delete'])->name('tags.delete');
    });

    Route::prefix('posts')->group(function () {
        Route::post('/like/{id}', [LikeController::class, 'create'])->name('posts.like')->can('create', Like::class);
        Route::post('/comment/{id}', [CommentController::class, 'create'])->name('posts.comment')->can('create', Comment::class);

        Route::get('/my', [PostController::class, 'myPosts'])->name('posts.my');
        Route::get('/add', [PostController::class, 'addPost'])->name('posts.add')->can('create', Post::class);
        Route::post('/create', [PostController::class, 'create'])->name('posts.create')->can('create', Post::class);
        Route::post('/statusChange', [PostController::class, 'statusChange'])->name('posts.statusChange');
        Route::delete('/delete', [PostController::class, 'delete'])->name('posts.delete');
        Route::middleware('can:viewRequests,App\Models\Post')->group(function () {
            Route::match(['get', 'post'], '/requests', [PostController::class, 'requests'])->name('posts.requests');
        });
        Route::get('/{id}', [PostController::class, 'view'])->name('posts.detail')->can('view', Post::class);
    });

});

require __DIR__ . '/auth.php';
