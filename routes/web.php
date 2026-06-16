<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CardController;
use Illuminate\Support\Facades\Route;
use App\Models\Login;
use App\Http\Controllers\UpgradeController;
use App\Http\Controllers\SecureNoteController;
use App\Http\Controllers\IdentityController;
use App\Http\Controllers\FolderController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('logins', LoginController::class);
    Route::resource('cards', CardController::class);
    Route::get('/upgrade', [UpgradeController::class, 'show'])->name('upgrade.show');
    Route::post('/upgrade', [UpgradeController::class, 'activate'])->name('upgrade.activate');
    Route::resource('secure-notes', SecureNoteController::class);
    Route::resource('identities', IdentityController::class);
    Route::resource('folders', FolderController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
