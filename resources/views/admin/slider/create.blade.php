@extends('layouts.admin')

@section('title', 'Tambah Slider')

@section('content')
<div class="container-fluid px-4">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1" style="color: #1a1a1a;">Tambah Slider Baru</h2>
            <p class="text-muted mb-0">Tambahkan slide untuk homepage</p>
        </div>
        <a href="{{ route('admin.slider.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>

    <form action="{{ route('admin.slider.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

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
                                   value="{{ old('judul') }}" required autofocus>
                            @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Deskripsi</label>
                            <textarea name="deskripsi" rows="3" class="form-control">{{ old('deskripsi') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Link (opsional)</label>
                            <input type="url" name="link" class="form-control" value="{{ old('link') }}" placeholder="https://...">
                            <small class="text-muted">Link tujuan saat slide diklik</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Urutan</label>
                            <input type="number" name="urutan" class="form-control" value="{{ old('urutan', 0) }}" min="0">
                            <small class="text-muted">Semakin kecil angka, semakin atas urutannya</small>
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
                        <div id="image-preview" class="mb-3 d-none position-relative">
                            <img src="" alt="Preview" class="img-thumbnail w-100" style="max-height: 300px; object-fit: cover;">
                            <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2" onclick="removeImagePreview()">
                                <i class="fas fa-times"></i> Hapus
                            </button>
                        </div>
                        
                        <input type="file" name="file_path" id="file_path" class="form-control mb-2" accept="image/*" required>
                        <small class="text-muted">Format: JPG, PNG (Max 5MB) | Rekomendasi: 1920x600px (landscape)</small>
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="col-lg-4">
                
                {{-- Tips --}}
                <div class="card border-0 shadow-sm mb-4 bg-light">
                    <div class="card-body">
                        <h6 class="fw-semibold mb-3">
                            <i class="fas fa-lightbulb me-2 text-warning"></i>Tips Slider
                        </h6>
                        <ul class="small mb-0">
                            <li>Gunakan gambar landscape (horizontal)</li>
                            <li>Ukuran ideal: 1920x600px</li>
                            <li>Hindari terlalu banyak teks di gambar</li>
                            <li>Maksimal 5-7 slider aktif</li>
                            <li>Link opsional (kosongkan jika tidak perlu)</li>
                        </ul>
                    </div>
                </div>

                {{-- Submit --}}
                <div class="d-grid">
                    <button type="submit" class="btn btn-dark btn-lg">
                        <i class="fas fa-save me-2"></i>Simpan Slider
                    </button>
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
</style>
@endpush

@push('scripts')
<script>
const fileInput = document.getElementById('file_path');
const preview = document.getElementById('image-preview');

fileInput.addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.querySelector('img').src = e.target.result;
            preview.classList.remove('d-none');
        };
        reader.readAsDataURL(file);
    }
});

function removeImagePreview() {
    preview.classList.add('d-none');
    preview.querySelector('img').src = '';
    fileInput.value = '';
}
</script>
@endpush
