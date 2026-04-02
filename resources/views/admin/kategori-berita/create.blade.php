@extends('layouts.admin')

@section('title', 'Tambah Kategori Berita')

@section('content')
<div class="container-fluid px-4">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold" style="color: #1a1a1a;">Tambah Kategori Baru</h2>
        <a href="{{ route('admin.kategori-berita.index') }}" class="btn btn-outline-dark">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    
                    <form action="{{ route('admin.kategori-berita.store') }}" method="POST">
                        @csrf

                        {{-- Nama Kategori --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold">
                                Nama Kategori <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('nama_kategori') is-invalid @enderror" 
                                   name="nama_kategori" 
                                   value="{{ old('nama_kategori') }}"
                                   placeholder="Contoh: Politik, Olahraga, Teknologi"
                                   required
                                   autofocus>
                            @error('nama_kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">
                                <i class="fas fa-info-circle me-1"></i>
                                Nama kategori harus unik dan maksimal 100 karakter
                            </small>
                        </div>

                        {{-- Deskripsi --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold">
                                Deskripsi (Opsional)
                            </label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                      name="deskripsi" 
                                      rows="4"
                                      placeholder="Deskripsi singkat tentang kategori ini...">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Maksimal 500 karakter</small>
                        </div>

                        {{-- Status Aktif --}}
                        <div class="mb-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" 
                                       type="checkbox" 
                                       name="is_active" 
                                       id="is_active"
                                       {{ old('is_active', true) ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold" for="is_active">
                                    Aktifkan Kategori
                                </label>
                            </div>
                            <small class="text-muted">
                                Kategori nonaktif tidak akan ditampilkan di form berita
                            </small>
                        </div>

                        {{-- Submit --}}
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-dark px-4">
                                <i class="fas fa-save me-2"></i>Simpan Kategori
                            </button>
                            <a href="{{ route('admin.kategori-berita.index') }}" class="btn btn-light px-4">
                                Batal
                            </a>
                        </div>

                    </form>

                </div>
            </div>
        </div>

        {{-- Sidebar Info --}}
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <h6 class="mb-0 fw-bold">
                        <i class="fas fa-lightbulb me-2"></i>Tips Kategori
                    </h6>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-3">
                            <i class="fas fa-check text-success me-2"></i>
                            Gunakan nama yang jelas dan spesifik
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-check text-success me-2"></i>
                            Hindari nama yang terlalu panjang
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-check text-success me-2"></i>
                            Slug akan dibuat otomatis dari nama
                        </li>
                        <li class="mb-0">
                            <i class="fas fa-check text-success me-2"></i>
                            Kategori dapat dinonaktifkan tanpa dihapus
                        </li>
                    </ul>
                </div>
            </div>

            <div class="alert alert-info border-0 shadow-sm mt-3">
                <h6 class="alert-heading fw-bold">
                    <i class="fas fa-info-circle me-2"></i>Catatan
                </h6>
                <p class="mb-0 small">
                    Setelah kategori dibuat, Anda dapat menggunakannya saat membuat atau mengedit berita.
                </p>
            </div>
        </div>
    </div>

</div>
@endsection

@push('styles')
<style>
.btn-dark {
    background: #1a1a1a;
    border: none;
    transition: all 0.3s;
}

.btn-dark:hover {
    background: #dc3545;
    transform: translateY(-2px);
}

.card {
    border-radius: 12px;
}

.form-control:focus,
.form-check-input:focus {
    border-color: #1a1a1a;
    box-shadow: 0 0 0 0.25rem rgba(26, 26, 26, 0.1);
}

.form-check-input:checked {
    background-color: #1a1a1a;
    border-color: #1a1a1a;
}
</style>
@endpush
