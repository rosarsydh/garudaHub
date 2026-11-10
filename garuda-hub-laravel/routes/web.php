<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/projects');

// Auth
Route::get('/register', [AuthController::class, 'showRegister'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->middleware('guest');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Proyek: lihat daftar & detail untuk semua orang, kelola hanya klien
Route::resource('projects', ProjectController::class)->only(['index', 'show']);
Route::resource('projects', ProjectController::class)
    ->except(['index', 'show'])
    ->middleware(['auth', 'role:klien']);
