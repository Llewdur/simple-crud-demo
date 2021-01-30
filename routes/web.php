<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes([
    'register' => false,
]);

Route::get('/', [App\Http\Controllers\HomeController::class, 'login']);

Route::group([
    'middleware' => ['auth'],
], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/interests/datatable', [App\Http\Controllers\InterestController::class, 'datatable']);
    Route::resource('/interests', App\Http\Controllers\InterestController::class);

    Route::get('/languages/datatable', [App\Http\Controllers\LanguageController::class, 'datatable']);
    Route::resource('/languages', App\Http\Controllers\LanguageController::class);

    Route::get('/users/datatable', [App\Http\Controllers\UserController::class, 'datatable']);
    Route::resource('/users', App\Http\Controllers\UserController::class);
});
