<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController; 
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\LayananController; 
use App\Http\Controllers\PengumumanController; 
use App\Http\Controllers\SliderController;
use App\Http\Controllers\AlbumController; 
use App\Http\Controllers\GaleriFotoController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. ROUTE PUBLIK (Tanpa Login)
Route::get('/', [HomeController::class, 'index'])->name('home');

// Profil
Route::get('/profil', [ProfilController::class, 'index'])->name('profil.index');

// Galeri
Route::get('/galeri', [GaleriFotoController::class, 'indexPublic'])->name('public.galeri.index');
Route::get('/galeri/{id}', [GaleriFotoController::class, 'showPublic'])->name('public.galeri.show');

// Layanan
Route::get('/layanan', [LayananController::class, 'publicList'])->name('public.layanan.index');
Route::get('/layanan/{id}', [LayananController::class, 'showPublic'])->name('public.layanan.show');

// Berita
Route::get('/berita', [BeritaController::class, 'publicList'])->name('berita.index');
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');

// Pengumuman
Route::get('/pengumuman', [PengumumanController::class, 'publicList'])->name('public.pengumuman.index');
Route::get('/pengumuman/{id}', [PengumumanController::class, 'showPublic'])->name('public.pengumuman.show');


// 2. ROUTE DASHBOARD (Bawaan Breeze)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


// 3. ROUTE PROTECTED (Harus Login)
Route::middleware('auth')->group(function () {
    
    // Route Profile User (Bawaan Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- ROUTE ADMIN AREA ---
    Route::prefix('admin')->name('admin.')->group(function () {
        
        // Dashboard Admin
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // CRUD Berita (Admin)
        Route::resource('berita', BeritaController::class);
        
        // CRUD Pengumuman (Admin)
        Route::resource('pengumuman', PengumumanController::class);

        // CRUD Layanan (Admin)
        Route::resource('layanan', LayananController::class);

        // CRUD Album (Admin)
        Route::resource('album', AlbumController::class);

        // CRUD Galeri Foto (Admin)
        Route::resource('galeri-foto', GaleriFotoController::class)->parameters([
            'galeri-foto' => 'galeriFoto' 
        ]);

        // CRUD Slider (Admin)
        Route::resource('slider', SliderController::class);

        // Profil Polres (Admin) - Edit/Update Profil Statis
        Route::get('/profil/edit', [ProfilController::class, 'edit'])->name('profil.edit');
        Route::put('/profil/update', [ProfilController::class, 'update'])->name('profil.update');

    });

}); 


// 4. INCLUDE ROUTE OTENTIKASI (Login/Register)
require __DIR__.'/auth.php';
