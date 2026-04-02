<?php
 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\ProfilPolresController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriBeritaController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\MenuNavigasiController;
use App\Http\Controllers\Auth\LoginController;
 
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
 
// =====================================================
// PUBLIC ROUTES
// =====================================================
 
// Homepage
Route::get('/', [HomeController::class, 'index'])->name('home');
 
// Profil Polres
Route::get('/profil', [ProfilPolresController::class, 'index'])->name('profil.index');
 
// Berita
Route::get('/berita', [BeritaController::class, 'publicList'])->name('berita.index');
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');
 
// Layanan
Route::get('/layanan', [LayananController::class, 'publicList'])->name('public.layanan.index');
Route::get('/layanan/{slug}', [LayananController::class, 'show'])->name('public.layanan.show');
 
// Pengumuman
Route::get('/pengumuman', [PengumumanController::class, 'publicList'])->name('public.pengumuman.index');
Route::get('/pengumuman/{id}', [PengumumanController::class, 'showPublic'])->name('public.pengumuman.show');
 
// Galeri (Album Foto)
Route::get('/galeri', [AlbumController::class, 'indexPublic'])->name('public.galeri.index');
Route::get('/galeri/{id}', [AlbumController::class, 'showPublic'])->name('public.galeri.show');
Route::get('/galeri/{id}/download', [AlbumController::class, 'download'])->name('public.galeri.download');
 
// =====================================================
// AUTH ROUTES
// =====================================================
 
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('throttle:5,1');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
 
// =====================================================
// ADMIN ROUTES (Protected by Auth Middleware)
// =====================================================
 
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // ─────────────────────────────────────────────────
    // Profil Polres Management
    // ─────────────────────────────────────────────────
    Route::get('/profil/edit', [ProfilPolresController::class, 'edit'])->name('profil.edit');
    Route::put('/profil/update', [ProfilPolresController::class, 'update'])->name('profil.update');
    
    // Struktur Organisasi
    Route::get('/profil/struktur-organisasi', [ProfilPolresController::class, 'editStruktur'])->name('profil.struktur');
    Route::put('/profil/struktur-organisasi/update', [ProfilPolresController::class, 'updateStruktur'])->name('profil.struktur.update');
    
    // Delete Image via AJAX (NEW!)
    Route::delete('/profil/delete-image', [ProfilPolresController::class, 'deleteImage'])->name('profil.delete-image');
    
    // ─────────────────────────────────────────────────
    // Kategori Berita - FULL RESOURCE
    // ─────────────────────────────────────────────────
    Route::resource('kategori-berita', KategoriBeritaController::class);
    Route::post('/kategori-berita/{id}/toggle-active', [KategoriBeritaController::class, 'toggleActive'])->name('kategori-berita.toggle-active');
    
    // ─────────────────────────────────────────────────
    // Berita (Local Storage: storage/berita/)
    // ─────────────────────────────────────────────────
    Route::resource('berita', BeritaController::class);
    
    // ─────────────────────────────────────────────────
    // Layanan (Local Storage: storage/layanan/)
    // ─────────────────────────────────────────────────
    Route::resource('layanan', LayananController::class);
    
    // ─────────────────────────────────────────────────
    // Pengumuman (Local Storage: storage/pengumuman/)
    // Supports images AND videos!
    // ─────────────────────────────────────────────────
    Route::resource('pengumuman', PengumumanController::class);
    
    // ─────────────────────────────────────────────────
    // Album/Galeri (Local Storage: storage/galeri/)
    // ─────────────────────────────────────────────────
    Route::resource('album', AlbumController::class);
    Route::delete('/album/{album}/photo/{photo}', [AlbumController::class, 'deletePhoto'])->name('album.photo.delete');
    Route::get('/album/{id}/download', [AlbumController::class, 'download'])->name('album.download');
    
    // ─────────────────────────────────────────────────
    // Slider (Local Storage: storage/slider/)
    // ─────────────────────────────────────────────────
    Route::resource('slider', SliderController::class);
    
    // ─────────────────────────────────────────────────
    // Menu Navigasi
    // ─────────────────────────────────────────────────
    Route::get('/menu', [MenuNavigasiController::class, 'index'])->name('menu.index');
    Route::post('/menu/update-order', [MenuNavigasiController::class, 'updateOrder'])->name('menu.update-order');
    Route::resource('menu', MenuNavigasiController::class)->except(['index']);
    
});
 
// =====================================================
// Fallback Route (404)
// =====================================================
 
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
