<?php

use App\Http\Controllers\Admin\CounselingSessionController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\ChatController;
use App\Http\Controllers\User\WellnessController;
use Illuminate\Support\Facades\Route;

Route::get('/', LandingPageController::class)->name('landing');

Route::get('/dashboard', function () {
    if (auth()->user()->isAdmin()) {
        return redirect()->route('admin.sessions.index');
    }

    return redirect()->route('wellness.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/ruang-tenang', [WellnessController::class, 'index'])->name('wellness.index');
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/chat/new', [ChatController::class, 'newSession'])->name('chat.new');
    Route::get('/chat/{session}', [ChatController::class, 'show'])->name('chat.show');
    Route::post('/chat/{session}', [ChatController::class, 'store'])->name('chat.store');
});

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users.index');

        Route::get('/sessions', [CounselingSessionController::class, 'index'])->name('sessions.index');
        Route::get('/sessions/{session}', [CounselingSessionController::class, 'show'])->name('sessions.show');
        Route::patch('/sessions/{session}', [CounselingSessionController::class, 'update'])->name('sessions.update');

        Route::get('/settings', [SiteSettingController::class, 'edit'])->name('settings.edit');
        Route::patch('/settings', [SiteSettingController::class, 'update'])->name('settings.update');
    });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
