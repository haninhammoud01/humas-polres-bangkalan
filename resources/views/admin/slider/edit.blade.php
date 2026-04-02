@extends('layouts.admin')

@section('title', 'Edit Slider')

@section('content')
<div class="container-fluid px-4">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1" style="color: #1a1a1a;">Edit Slider</h2>
            <p class="text-muted mb-0">{{ $slider->judul }}</p>
        </div>
        <a href="{{ route('admin.slider.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>

    <form action="{{ route('admin.slider.update', $slider->id_slider) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row g-4">
            <div class="col-lg-8">
                
                {{-- Info Slider --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-semibold">
                            <i class="fas fa-sliders-h me-2 text-primary"></i>Informasi Slider
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Judul <span class="text-danger">*</span></label>
                            <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" 
                                   value="{{ old('judul', $slider->judul) }}" required>
                            @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Deskripsi</label>
                            <textarea name="deskripsi" rows="3" class="form-control">{{ old('deskripsi', $slider->deskripsi) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Link (opsional)</label>
                            <input type="url" name="link" class="form-control" value="{{ old('link', $slider->link) }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Urutan</label>
                            <input type="number" name="urutan" class="form-control" value="{{ old('urutan', $slider->urutan) }}" min="0">
                        </div>
                    </div>
                </div>

                {{-- Gambar Slider --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-semibold">
                            <i class="fas fa-image me-2 text-success"></i>Gambar Slider
                        </h5>
                    </div>
                    <div class="card-body">
                        @if($slider->file_path)
                        <div class="mb-3">
                            <img src="{{ $slider->file_url }}" alt="Current" class="img-thumbnail w-100" style="max-height: 300px; object-fit: cover;">
                            <div class="text-muted small mt-1">
                                File: {{ basename($slider->file_path) }}
                            </div>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="delete_file" id="delete_file" value="1">
                            <label class="form-check-label text-danger fw-semibold" for="delete_file">
                                <i class="fas fa-trash me-1"></i>Hapus gambar saat ini
                            </label>
                        </div>
                        @else
                        <div class="alert alert-warning mb-3">
                            <i class="fas fa-exclamation-triangle me-2"></i>Belum ada gambar
                        </div>
                        @endif
                        
                        <label class="form-label fw-semibold">Upload Gambar Baru</label>
                        <input type="file" name="file_path" id="file_path" class="form-control mb-2" accept="image/*">
                        <small class="text-muted">Format: JPG, PNG (Max 5MB) | Upload baru akan otomatis mengganti yang lama</small>
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="col-lg-4">
                
                {{-- Status --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-semibold">
                            <i class="fas fa-toggle-on me-2 text-warning"></i>Status
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" 
                                   {{ old('is_active', $slider->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold" for="is_active">
                                Aktif
                            </label>
                        </div>
                        <small class="text-muted">Slider hanya muncul jika aktif</small>
                    </div>
                </div>

                {{-- Submit --}}
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-dark btn-lg">
                        <i class="fas fa-save me-2"></i>Update Slider
                    </button>
                    <a href="{{ route('home') }}" class="btn btn-outline-secondary" target="_blank">
                        <i class="fas fa-eye me-2"></i>Lihat Homepage
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
