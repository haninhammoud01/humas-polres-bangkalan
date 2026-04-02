@extends('layouts.admin')

@section('title', 'Edit Struktur Organisasi')

@section('content')
<div class="container-fluid px-4">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1" style="color: #1a1a1a;">Edit Struktur Organisasi</h2>
            <p class="text-muted mb-0">Kelola struktur organisasi Polres Bangkalan</p>
        </div>
        <a href="{{ route('admin.profil.edit') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Kembali ke Profil
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form action="{{ route('admin.profil.struktur.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row g-4">
            <div class="col-lg-8">
                
                {{-- Teks Struktur --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-semibold">
                            <i class="fas fa-align-left me-2 text-primary"></i>Deskripsi Struktur (Opsional)
                        </h5>
                    </div>
                    <div class="card-body">
                        <textarea name="struktur_organisasi_text" rows="8" class="form-control">{{ old('struktur_organisasi_text', $profil->struktur_organisasi_text) }}</textarea>
                        <small class="text-muted">Deskripsi atau penjelasan struktur organisasi dalam bentuk teks</small>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                
                {{-- Gambar/Bagan Struktur --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-semibold">
                            <i class="fas fa-sitemap me-2 text-success"></i>Bagan Struktur
                        </h5>
                    </div>
                    <div class="card-body">
                        @if($profil->struktur_organisasi_image)
                        <div class="mb-3">
                            <img src="{{ $profil->struktur_organisasi_image_url }}" alt="Struktur" class="img-thumbnail w-100">
                            <div class="text-muted small mt-1">
                                File: {{ basename($profil->struktur_organisasi_image) }}
                            </div>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="delete_struktur_image" id="delete_struktur_image" value="1">
                            <label class="form-check-label text-danger fw-semibold" for="delete_struktur_image">
                                <i class="fas fa-trash me-1"></i>Hapus bagan saat ini
                            </label>
                        </div>
                        @else
                        <div class="alert alert-warning mb-3">
                            <i class="fas fa-exclamation-triangle me-2"></i>Belum ada bagan struktur
                        </div>
                        @endif
                        
                        <label class="form-label fw-semibold">Upload Bagan Baru</label>
                        <input type="file" name="struktur_organisasi_image" id="struktur_image" class="form-control mb-2" accept="image/*">
                        <small class="text-muted">Format: JPG, PNG (Max 5MB)<br>Upload baru akan otomatis mengganti yang lama</small>
                    </div>
                </div>

                {{-- Submit --}}
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-dark btn-lg">
                        <i class="fas fa-save me-2"></i>Simpan Perubahan
                    </button>
                    <a href="{{ route('profil.index') }}" class="btn btn-outline-secondary" target="_blank">
                        <i class="fas fa-eye me-2"></i>Lihat Halaman Publik
                    </a>
                </div>
            </div>
        </div>
    </form>

</div>
@endsection

@push('styles')
<style>
.card { border-radius: 12px; }
.btn-dark {
    background: #1a1a1a !important;
    border: none !important;
    transition: all 0.3s;
}
.btn-dark:hover {
    background: #dc3545 !important;
    transform: translateY(-2px);
}
.form-control { border-radius: 8px; }
.form-check-input:checked {
    background-color: #dc3545;
    border-color: #dc3545;
}
</style>
@endpush
