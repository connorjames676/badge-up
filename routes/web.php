<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AttemptController;
use App\Http\Controllers\ChallengeController;
use App\Models\Challenge;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::redirect('/', '/dashboard');

Route::get('/dashboard', function () {
    return redirect()->route('challenges.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');

    Route::get('/attempts', [AttemptController::class, 'index'])->name('attempts.index');
    Route::get('/attempts/create', [AttemptController::class, 'create'])->name('attempts.create');
    Route::post('/attempts', [AttemptController::class, 'store'])->name('attempts.store');

    Route::get('/challenges', [ChallengeController::class, 'index'])->name('challenges.index');
    Route::get('/challenges/create', [ChallengeController::class, 'create'])->name('challenges.create');
    Route::post('/challenges', [ChallengeController::class, 'store'])->name('challenges.store');
    Route::get('/challenges/{id}', [ChallengeController::class, 'show'])->name('challenges.show');
});


require __DIR__.'/auth.php';

Route::get('/homepage', function() {
    return view('layouts.main');
});
