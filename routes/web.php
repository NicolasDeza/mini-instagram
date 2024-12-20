<?php
use Illuminate\Http\Request;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\CommentController;

// Page d'accueil
Route::get('/', function () {
    return Auth::check() ? redirect()->route('posts.index') : redirect()->route('login');
});


// Dashboard protégé par authentification
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/home', [FeedController::class, 'index'])->name('home');
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/user/{user}', [ProfileController::class, 'show'])->name('user.profile');
    Route::post('/follow/{user}', [FollowController::class, 'store'])->name('follow.store');
    Route::delete('/unfollow/{user}', [FollowController::class, 'destroy'])->name('follow.destroy');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::post('/posts/{post}/like', [LikeController::class, 'toggleLike'])->name('posts.like');
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profil/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::get('/search', [SearchController::class, 'index'])->name('search');








require __DIR__.'/auth.php';
