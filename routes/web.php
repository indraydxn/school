<?php

use App\Http\Controllers\Backend\UserPrintController;
use Illuminate\Support\Facades\Route;

// Root
Route::get('/', function () {
    return redirect()->route('admin.dashboard');
});

// Login
Route::middleware('guest')->get('login', App\Livewire\Auth\Login::class)->name('login');

// Admin
Route::middleware('auth')->group(function () {

    // Admin
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {

        // Dashboard
        Route::get('dashboard', App\Livewire\Backend\Dashboard::class)->name('dashboard');

        // Users
        Route::prefix('user')->name('user.')->group(function () {
            Route::get('/', App\Livewire\Backend\User\Index::class)->name('index');
            Route::get('/print', UserPrintController::class)->name('print');
            Route::get('/{user}/edit', App\Livewire\Backend\User\Edit::class)->name('edit');
        });

    });
    
});

