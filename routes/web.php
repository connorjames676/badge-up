<?php

use App\Http\Controllers\MyUserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/users', [MyUserController::class, 'index']);

Route::get('/users/{id}', [MyUserController::class, 'show']);