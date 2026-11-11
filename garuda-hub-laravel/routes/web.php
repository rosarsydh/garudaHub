<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BidController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;

Route::redirect('/', '/projects');

// Auth
Route::get('/register', [AuthController::class, 'showRegister'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->middleware('guest');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Proyek: daftar & detail untuk semua orang, kelola hanya klien
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');

Route::middleware(['auth', 'role:klien'])->group(function () {
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');
});

Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');

// Penawaran: developer mengajukan, klien memilih pemenang
Route::post('/projects/{project}/bids', [BidController::class, 'store'])
    ->name('bids.store')->middleware(['auth', 'role:developer']);

Route::post('/projects/{project}/bids/{bid}/pick', [BidController::class, 'pick'])
    ->name('bids.pick')->middleware(['auth', 'role:klien']);

    // Dasbor: klien dan developer saja (admin tidak punya dasbor)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')->middleware(['auth', 'role:klien,developer']);

    // Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::patch('/users/{user}/role', [AdminController::class, 'setRole'])->name('users.role');
    Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('users.destroy');
    Route::delete('/projects/{project}', [AdminController::class, 'destroyProject'])->name('projects.destroy');
});
