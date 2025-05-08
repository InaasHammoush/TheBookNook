<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;



Route::get('/dashboard', function () {
    if (auth()->user()->isAdmin()) {
        return app(DashboardController::class)->adminDashboard();
    } else {
        return app(DashboardController::class)->userDashboard();
    }
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth', 'admin'])->prefix('')->group(function () {
    Route::get('/admin/users', [UserController::class, 'index'])->name('users.index');
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::post('/admin/users/{user}/promote', [UserController::class, 'promote'])->name('users.promote');
    Route::post('/admin/users/{user}/demote', [UserController::class,'demote'])->name('users.demote');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/genres/{genre}', [GenreController::class, 'show'])->name('genres.show');

Route::middleware(['auth'])->group(function () {
    Route::get('/threads/create', [ThreadController::class, 'create'])->name('threads.create');
    Route::post('/threads', [ThreadController::class, 'store'])->name('threads.store');
});

Route::get('/search-threads', [SearchController::class, 'index'])->name('search.threads');

Route::middleware(['auth'])->group(function () {
    Route::get('/threads/{thread}/edit', [ThreadController::class, 'edit'])->name('threads.edit');
    Route::put('/threads/{thread}', [ThreadController::class, 'update'])->name('threads.update');
    Route::delete('/threads/{thread}', [ThreadController::class, 'destroy'])->name('threads.destroy');
    Route::post('/threads/{thread}/bookmark', [BookmarkController::class, 'store'])->name('threads.bookmark');
    Route::delete('/threads/{thread}/unbookmark', [BookmarkController::class, 'destroy'])->name('threads.unbookmark');

    Route::get('/comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');
    Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});

Route::get('/threads/{thread}', [ThreadController::class, 'show'])->name('threads.show');
Route::post('/threads/{thread}/comments', [CommentController::class, 'store'])->name('comments.store');

require __DIR__.'/auth.php';
