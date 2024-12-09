<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Redirect root to /register to make the register page the first page
Route::get('/', function () {
    return redirect()->route('register');
})->name('home');

// Registration Routes
Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register.store');

// Routes for authenticated users to manage posts
Route::middleware(['auth', 'verified'])->group(function () {
    // Index route for displaying posts
    Route::get('posts', [PostController::class, 'index'])->name('posts.index');

    // Create route
    Route::get('posts/create', [PostController::class, 'create'])->name('posts.create');

    // Store route
    Route::post('posts', [PostController::class, 'store'])->name('posts.store');

    // Show route for a single post
    Route::get('posts/{post}', [PostController::class, 'show'])->name('posts.show');

    // Edit route
    Route::get('posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');

    // Update route
    Route::put('posts/{post}', [PostController::class, 'update'])->name('posts.update');

    // Delete route
    Route::delete('posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
});

// Route for the dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Include authentication routes (Login, Register, etc.)
require __DIR__ . '/auth.php';
