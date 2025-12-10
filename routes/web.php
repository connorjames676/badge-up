<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AttemptController;
use App\Http\Controllers\ChallengeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;
use App\Livewire\CreateComment;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Carbon;

Route::get('/', function () {
    return view('welcome');
});

//Route::redirect('/', '/dashboard');

Route::get('/dashboard', function () {
    $user = auth()->user();
    $now = Carbon::now();

    $joined = auth()->user()->joinChallenges;

    $active = $user->joinChallenges()
        ->whereDate('start_date', '<=', $now)
        ->whereDate('end_date', '>=', $now)
        ->with('user')
        ->paginate(3);

    $upcoming = $user->joinChallenges()
        ->whereDate('start_date', '>', $now)
        ->with('user')
        ->paginate(3);

    $past = $user->joinChallenges()
        ->whereDate('end_date', '<', $now)
        ->with('user')
        ->paginate(3);

    return view('dashboard', compact(
        'joined',
        'active',
        'upcoming',
        'past'
    ));
})->middleware(['auth', 'verified'])->name('dashboard');

/*Route::get('/dashboard', function () {
    //return redirect()->route('challenges.index');
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');*/

Route::middleware('auth')->group(function () {
    Route::get('/account', [AccountController::class, 'edit'])->name('account.edit');
    Route::patch('/account', [AccountController::class, 'update'])->name('account.update');
    Route::delete('/account', [AccountController::class, 'destroy'])->name('account.destroy');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('user.destroy');

    Route::get('profile/bio', [ProfileController::class, 'bioEdit'])->name('bio.edit');
    Route::patch('/profile/bio/{id}', [ProfileController::class, 'bioUpdate'])->name('bio.update');
    Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');
    //Route::get('/profile/{id}', [ProfileController::class, 'showOther'])->name('profile.show-other');

    Route::get('/attempts', [AttemptController::class, 'index'])->name('attempts.index');
    //Route::get('/attempts/create', [AttemptController::class, 'create'])->name('attempts.create');
    Route::get('/challenges/{id}/attempts/create', [AttemptController::class, 'create'])->name('attempts.create');
    Route::post('/challenges/{id}/attempts', [AttemptController::class, 'store'])->name('attempts.store');
    Route::get('/attempts/{id}', [AttemptController::class, 'show'])->name('attempts.show');
    Route::get('/attempts/{id}/edit', [AttemptController::class, 'edit'])->name('attempts.edit');
    Route::patch('/attempts/{id}', [AttemptController::class, 'update'])->name('attempts.update');
    Route::delete('/attempts/{id}', [AttemptController::class, 'destroy'])->name('attempts.destroy');

    //Route::get('/challenge/{id}/attempts', [AttemptController::class, 'getAttempts'])->name('challenge.attempts');

    Route::post('attempts/{id}/like', [LikeController::class, 'store'])->name('likes.store');
    Route::delete('attempts/{id}/unlike', [LikeController::class, 'destroy'])->name('likes.destroy');

    //Route::get('/attempts/{id}/comments/create', [CommentController::class, 'create'])->name('comments.create');
    Route::get('/attempts/{id}/comments/create', CreateComment::class)->name('comments.create');
    //Route::post('/attempts/{attempt}/comment', [CommentController::class, 'store'])->name('comments.store');
    Route::get('/attempts/{attempt}/comment/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');
    Route::patch('attempts/{attempt}/comment/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/attempts/{attempt}/comment/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

    Route::get('/challenges', [ChallengeController::class, 'index'])->name('challenges.index');
    Route::get('/challenges/create', [ChallengeController::class, 'create'])->name('challenges.create');
    Route::post('/challenges', [ChallengeController::class, 'store'])->name('challenges.store');
    Route::get('/challenges/{id}', [ChallengeController::class, 'show'])->name('challenges.show');
    Route::get('/challenges/{id}/edit', [ChallengeController::class, 'edit'])->name('challenges.edit');
    Route::patch('/challenges/{id}', [ChallengeController::class, 'update'])->name('challenges.update');
    Route::delete('/challenges/{id}', [ChallengeController::class, 'destroy'])->name('challenges.destroy');

    Route::patch('/challenges/{id}/join', [ChallengeController::class, 'join'])->name('challenge.join');
    Route::patch('/challenges/{id}/leave', [ChallengeController::class, 'leave'])->name('challenge.leave');
});


require __DIR__.'/auth.php';

Route::get('/homepage', function() {
    return view('layouts.main');
});
