<?php

use Illuminate\Support\Facades\Route;

// Root
Route::get('/', function () {
    return redirect()->route('admin.dashboard');
});

// Login
Route::get('login', App\Livewire\Auth\Login::class)->name('login');
Route::post('logout', [App\Livewire\Auth\Login::class, 'logout'])->name('logout');

// Admin
Route::middleware('auth', 'role:admin')->prefix('admin')->name('admin.')->group(function () {
        
    // Dashboard
    Route::get('dashboard', App\Livewire\Backend\Dashboard::class)->name('dashboard');

    // Users
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/', App\Livewire\Backend\User\Index::class)->name('index');
    });

});

