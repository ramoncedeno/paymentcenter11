<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

//Export Users
Route::get('/export-users', [UserController::class, 'export'])->name('export.user');


// Routes user import
Route::get('/import-users', [UserController::class, 'showimportform'])->name('import.users'); // view form
Route::post('/import-users', [UserController::class, 'usersimportform'])->name('import.users'); //Import file from form
