<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\NilaiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route Halaman Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/home', [DashboardController::class, 'index'])->name('home');

// Route Autentikasi bawaan (Login, Register, Logout, dll)
Auth::routes();

// Route Master Data yang diamankan dengan middleware auth (hanya bisa diakses setelah login)
Route::middleware(['auth'])->group(function () {
    Route::resource('kelas', KelasController::class);
    Route::resource('siswa', SiswaController::class);
    Route::resource('guru', GuruController::class);
    Route::resource('mapel', MapelController::class);
    Route::resource('nilai', NilaiController::class);
});