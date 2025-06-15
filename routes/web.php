<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/berita');
});

Route::resource('categories', CategoryController::class);
Route::resource('posts', PostController::class);

Route::post('/posts/{post}/comments', [App\Http\Controllers\CommentController::class, 'store'])->name('comments.store')->middleware('auth');

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});

Route::middleware('auth')->group(function () {
    Route::post('posts/{post}/approve', [App\Http\Controllers\PostController::class, 'approve'])->name('posts.approve');
});

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

Route::get('/comments', function() {
    $comments = \App\Models\Comment::with('user')->latest()->get();
    return view('comments.index', compact('comments'));
})->name('comments.index')->middleware(['auth']);

// Public News Portal
Route::get('/berita', [App\Http\Controllers\PublicPostController::class, 'index'])->name('public.posts.index');
Route::get('/berita/{slug}', [App\Http\Controllers\PublicPostController::class, 'show'])->name('public.posts.show');

Route::get('auth/{provider}', [App\Http\Controllers\Auth\SocialiteController::class, 'redirect'])->name('socialite.redirect');
Route::get('auth/{provider}/callback', [App\Http\Controllers\Auth\SocialiteController::class, 'callback'])->name('socialite.callback');