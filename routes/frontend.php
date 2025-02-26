<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\UserController;

Route::prefix('user')->group(function () {
    Route::get('/login', [UserController::class, 'login']);
});