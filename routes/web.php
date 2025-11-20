<?php

use App\Http\Controllers\MyUserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/users', [MyUserController::class, 'index'])->name('users.index');

Route::get('/users/create', [MyUserController::class, 'create'])->name('users.create');

Route::post('/users', [MyUserController::class, 'store'])->name('users.store');

Route::get('/users/{id}', [MyUserController::class, 'show'])->name('users.show');

Route::get('/homepage', function() {
    return view('layouts.homepage');
});