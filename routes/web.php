<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes([
    'register' => false,
]);

Route::get('/', [App\Http\Controllers\HomeController::class, 'login']);

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('/interests', App\Http\Controllers\InterestController::class);
    Route::resource('/languages', App\Http\Controllers\LanguageController::class);
    Route::resource('/users', App\Http\Controllers\UserController::class);
});
