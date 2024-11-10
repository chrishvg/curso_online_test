<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\DashboardController;

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('home');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/courses', [CourseController::class, 'index'])->name('course');
    Route::post('/courses', [CourseController::class, 'store'])->name('course.store');
    Route::post('/courses/register', [CourseController::class, 'register'])->name('course.register');
    Route::get('/courses/search', [CourseController::class, 'search'])->name('course.search');

    Route::get('/videos', [VideoController::class, 'index'])->name('videos');
    Route::post('/videos', [VideoController::class, 'store'])->name('video.store');
    Route::get('/videos/{video}/like', [VideoController::class, 'like'])->name('video.like');

    Route::get('/comments', [CommentController::class, 'index'])->name('comments');
    Route::get('/comments/{id}', [CommentController::class, 'writeComment'])->name('comments.write');
    Route::put('/comments/{comment}/approve', [CommentController::class, 'approve'])->name('comments.approve');
    Route::put('/comments/{comment}/decline', [CommentController::class, 'decline'])->name('comments.decline');
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');

    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('user.update');
    Route::post('/users', [UserController::class, 'store'])->name('user.store');
});

require __DIR__.'/auth.php';
