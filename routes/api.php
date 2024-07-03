<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['throttle:60,1', 'content.length'])->group(function () {
    Route::post('register', [UserController::class, 'register'])->name('users.register');
    Route::post('login', [UserController::class, 'login'])->name('users.login');

    Route::middleware('auth:api')->group(function () {
        Route::get('users', [UserController::class, 'index'])->name('users.index');
        Route::get('users/{id}', [UserController::class, 'show'])->name('users.show');
        Route::put('users/{id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('users/{id}', [UserController::class, 'destroy'])->name('users.delete');
    });
});