<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\PengumumanController; 
use App\Http\Controllers\DashboardController;   
use App\Http\Controllers\LayananController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. Route Publik (Beranda)
Route::get('/', [HomeController::class, 'index'])->name('home');

// 2. Route Publik Detail Berita
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('public.berita.show');

// 3. Route Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// 4. Route Protected (Harus Login)
Route::middleware('auth')->group(function () {
    
    // Route Profile (Bawaan Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // -- Route Admin Area --
    Route::prefix('admin')->name('admin.')->group(function () {
        
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // CRUD Berita
        Route::resource('/berita', BeritaController::class);
        
        // CRUD Pengumuman 
        Route::resource('/pengumuman', PengumumanController::class);

        // CRUD Layanan
        Route::resource('/layanan', LayananController::class);
    });
});

// 5. Include Route Otentikasi
require __DIR__.'/auth.php';
