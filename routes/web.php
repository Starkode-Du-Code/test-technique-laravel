<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordResetController;

// Page d'accueil redirigée vers la liste des articles
Route::get('/', function () {
    return redirect('/posts');
});

// Routes publiques
Route::get('posts', [PostController::class, 'index'])->name('posts.index');
Route::get('posts/create', [PostController::class, 'create'])->name('posts.create'); // Statique, sans middleware
Route::get('posts/{post}', [PostController::class, 'show'])->name('posts.show'); // Dynamique

// Routes protégées
Route::middleware('auth')->group(function () {
    // Gestion des articles
    Route::post('posts', [PostController::class, 'store'])->name('posts.store');
    Route::put('posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

    // Gestion des likes et commentaires
    Route::post('posts/{post}/like', [PostController::class, 'like'])->name('posts.like');
    Route::post('posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
});

// Gestion des utilisateurs
Route::middleware('auth')->group(function () {
    Route::get('/profile', function () {
        return view('profile', ['user' => auth()->user()]);
    })->name('profile');

    Route::get('/settings', function () {
        return view('settings');
    })->name('settings');
});

// Double authentification
Route::middleware('auth')->group(function () {
    Route::get('verify-2fa', [AuthController::class, 'showTwoFactorForm'])->name('verify.2fa');
    Route::post('verify-2fa', [AuthController::class, 'verifyTwoFactor']);
});

// Routes d'authentification
Route::get('login', [AuthController::class, 'loginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'registerForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Réinitialisation de mot de passe
Route::get('password/reset', [PasswordResetController::class, 'requestForm'])->name('password.request');
Route::post('password/email', [PasswordResetController::class, 'sendResetLink'])->name('password.email');
Route::get('password/reset/{token}', [PasswordResetController::class, 'resetForm'])->name('password.reset');
Route::post('password/reset', [PasswordResetController::class, 'resetPassword'])->name('password.update');

// Routes réservées aux administrateurs
Route::middleware(['auth', 'admin'])->group(function () {
    Route::delete('posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy.admin');
    Route::put('posts/{post}', [PostController::class, 'update'])->name('posts.update.admin');
});
