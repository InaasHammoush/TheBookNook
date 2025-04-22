<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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

Route::get('/threads/{thread}', [ThreadController::class, 'show'])->name('threads.show');
Route::post('/threads/{thread}/comments', [CommentController::class, 'store'])->name('comments.store');

require __DIR__.'/auth.php';
