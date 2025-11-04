<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
Route::resource('/staff', App\Http\Controllers\StaffController::class)->names('staff');