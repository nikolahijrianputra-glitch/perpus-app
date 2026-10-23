<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;

// Halaman beranda: kalau sudah login ke dashboard, kalau belum ke login
Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

// Semua route di dalam group ini cuma bisa diakses setelah login
Route::middleware(['auth'])->group(function () {
    // Halaman dashboard (butuh file resources/js/Pages/Dashboard.vue)
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    // 1 baris ini otomatis bikin 7 route CRUD buku
    Route::resource('books', BookController::class);

    // Route profil bawaan starter kit (hanya aktif kalau ProfileController ada)
    if (class_exists(ProfileController::class)) {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    }
});

require __DIR__.'/auth.php';