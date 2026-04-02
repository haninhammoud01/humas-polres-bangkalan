@extends('layouts.admin')

@section('title', 'Tambah Album Foto')

@section('content')
<div class="container-fluid px-4">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1" style="color: #1a1a1a;">Tambah Album Foto Baru</h2>
            <p class="text-muted mb-0">Buat album galeri foto</p>
        </div>
        <a href="{{ route('admin.album.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>

    <form action="{{ route('admin.album.store') }}" method="POST" enctype="multipart/form-data" id="album-form">
        @csrf

        <div class="row g-4">
            <div class="col-lg-8">
                
                {{-- Info Album --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-semibold">
                            <i class="fas fa-images me-2 text-primary"></i>Informasi Album
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Album <span class="text-danger">*</span></label>
                            <input type="text" name="nama_album" class="form-control @error('nama_album') is-invalid @enderror" 
                                   value="{{ old('nama_album') }}" required autofocus>
                            @error('nama_album')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Deskripsi</label>
                            <textarea name="deskripsi" rows="4" class="form-control">{{ old('deskripsi') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tanggal Dibuat <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_dibuat" class="form-control @error('tanggal_dibuat') is-invalid @enderror" 
                                   value="{{ old('tanggal_dibuat', date('Y-m-d')) }}" required>
                            @error('tanggal_dibuat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                {{-- Upload Foto --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-semibold">
                            <i class="fas fa-cloud-upload-alt me-2 text-success"></i>Upload Foto
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Pilih Foto (Multiple)</label>
                            <input type="file" name="photos[]" id="photos" class="form-control" accept="image/*" multiple>
                            <small class="text-muted">Format: JPG, PNG (Max 5MB per foto) | Bisa pilih beberapa foto sekaligus</small>
                        </div>

                        <div id="photo-preview" class="row g-3 mt-3"></div>
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="col-lg-4">
                
                {{-- Tips --}}
                <div class="card border-0 shadow-sm mb-4 bg-light">
                    <div class="card-body">
                        <h6 class="fw-semibold mb-3">
                            <i class="fas fa-lightbulb me-2 text-warning"></i>Tips Upload Foto
                        </h6>
                        <ul class="small mb-0">
                            <li>Pilih beberapa foto sekaligus dengan Ctrl+Click (Windows) atau Cmd+Click (Mac)</li>
                            <li>Foto pertama otomatis jadi cover album</li>
                            <li>Klik tombol <span class="badge bg-danger">×</span> untuk hapus foto sebelum upload</li>
                            <li>Rekomendasi ukuran: minimal 1200px</li>
                        </ul>
                    </div>
                </div>

                {{-- Submit --}}
                <div class="d-grid">
                    <button type="submit" class="btn btn-dark btn-lg">
                        <i class="fas fa-save me-2"></i>Simpan Album
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
.photo-preview-item {
    position: relative;
    border-radius: 8px;
    overflow: hidden;
}
.photo-preview-item img {
    width: 100%;
    height: 150px;
    object-fit: cover;
}
.remove-photo-btn {
    position: absolute;
    top: 5px;
    right: 5px;
    z-index: 10;
}
</style>
@endpush

@push('scripts')
<script>
let selectedFiles = [];

const fileInput = document.getElementById('photos');
const preview = document.getElementById('photo-preview');

// Preview multiple photos
fileInput.addEventListener('change', function(e) {
    selectedFiles = Array.from(e.target.files);
    updatePreview();
});

function updatePreview() {
    preview.innerHTML = '';
    
    selectedFiles.forEach((file, index) => {
        const reader = new FileReader();
        reader.onload = function(e) {
            const col = document.createElement('div');
            col.className = 'col-md-4';
            col.innerHTML = `
                <div class="photo-preview-item">
                    <img src="${e.target.result}" class="img-thumbnail">
                    <button type="button" class="btn btn-danger btn-sm remove-photo-btn" onclick="removePhoto(${index})">
                        <i class="fas fa-times"></i>
                    </button>
                    <div class="small text-muted mt-1">
                        ${index === 0 ? '<span class="badge bg-primary">Cover</span> ' : ''}
                        ${file.name}
                    </div>
                </div>
            `;
            preview.appendChild(col);
        };
        reader.readAsDataURL(file);
    });
}

function removePhoto(index) {
    // Remove from array
    selectedFiles.splice(index, 1);
    
    // Update file input with new DataTransfer
    const dt = new DataTransfer();
    selectedFiles.forEach(file => dt.items.add(file));
    fileInput.files = dt.files;
    
    // Update preview
    updatePreview();
}
</script>
@endpush
