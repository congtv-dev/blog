<?php

use App\Http\Controllers\Frontend\ArticleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Middleware\Frontend\Auth;

Route::prefix('user')->name('user.')->group(function () {
    Route::get('/login', [UserController::class, 'login'])->name('login');
    Route::post('/login', [UserController::class, 'signin'])->name('signin');

    Route::get('/logout', [UserController::class, 'logout'])->name('logout')->middleware(Auth::class);

    Route::get('/register', [UserController::class, 'register'])->name('register');
    Route::post('/register', [UserController::class, 'save'])->name('save');
});

Route::prefix('article')->name('article.')->group(function () {
    Route::get('/create', [ArticleController::class, 'create'])->name('create')->middleware(Auth::class);
    Route::post('/create', [ArticleController::class, 'save'])->name('save')->middleware(Auth::class);
    
    Route::get('/{id}/update', [ArticleController::class, 'update'])->middleware(Auth::class);
    Route::post('/{id}/update', [ArticleController::class, 'save'])->middleware(Auth::class);
    
    Route::get('/{id}/delete', [ArticleController::class, 'delete'])->middleware(Auth::class);
    
    Route::get('/{id}/{slug}', [ArticleController::class, 'read']);
});

Route::prefix('articles')->group(function () {
    Route::get('/{userId}/{fullname}', [ArticleController::class, 'publish']);
    Route::get('/{fullname}', [ArticleController::class, 'index'])->middleware(Auth::class);
});

Route::get('', [HomeController::class, 'index'])->name('home');