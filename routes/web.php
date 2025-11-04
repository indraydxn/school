<?php

use App\Exports\UserTemplateExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\UserPrintController;
use App\Http\Controllers\Backend\StaffPrintController;
use App\Http\Controllers\Backend\StudentPrintController;
use App\Http\Controllers\Backend\ParentPrintController;
use App\Http\Controllers\Backend\RolePrintController;

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
            Route::get('/template/download', function () { return Excel::download(new UserTemplateExport, 'template_import_user.xlsx'); })->name('template.download');
            Route::get('/{user}/edit', App\Livewire\Backend\User\Edit::class)->name('edit');

            // Staff
            Route::prefix('staff')->name('staff.')->group(function () {
                Route::get('/', App\Livewire\Backend\Staff\Index::class)->name('index');
                Route::get('/print', StaffPrintController::class)->name('print');
                Route::get('/{staf}/edit', App\Livewire\Backend\Staff\Edit::class)->name('edit');
            });

            // Siswa
            Route::prefix('student')->name('student.')->group(function () {
                Route::get('/', App\Livewire\Backend\Student\Index::class)->name('index');
                Route::get('/print', StudentPrintController::class)->name('print');
                Route::get('/{siswa}/edit', App\Livewire\Backend\Student\Edit::class)->name('edit');
            });

            // Wali Siswa
            Route::prefix('parent')->name('parent.')->group(function () {
                Route::get('/', App\Livewire\Backend\Parent\Index::class)->name('index');
                Route::get('/print', ParentPrintController::class)->name('print');
                Route::get('/{wali}/edit', App\Livewire\Backend\Parent\Edit::class)->name('edit');
            });

        });

        // Role
        Route::prefix('role')->name('role.')->group(function () {
            Route::get('/', App\Livewire\Backend\Role\Index::class)->name('index');
            Route::get('/print', RolePrintController::class)->name('print');
            Route::get('/{role}/edit', App\Livewire\Backend\Role\Edit::class)->name('edit');
        });

    });

});

