@extends('layouts.admin')

@section('title', 'Tambah Berita')

@section('content')
<div class="container-fluid px-4">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1" style="color: #1a1a1a;">Tambah Berita Baru</h2>
            <p class="text-muted mb-0">Buat berita untuk dipublikasikan</p>
        </div>
        <a href="{{ route('admin.berita.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>

    <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row g-4">
            <div class="col-lg-8">
                
                {{-- Konten Berita --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-semibold">
                            <i class="fas fa-newspaper me-2 text-primary"></i>Konten Berita
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Judul Berita <span class="text-danger">*</span></label>
                            <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" 
                                   value="{{ old('judul') }}" required autofocus>
                            @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            <small class="text-muted">URL otomatis dibuat dari judul</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Ringkasan</label>
                            <textarea name="ringkasan" rows="3" class="form-control" 
                                      placeholder="Ringkasan singkat berita (opsional)">{{ old('ringkasan') }}</textarea>
                            <small class="text-muted">Ditampilkan di card preview dan meta description</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Konten Berita <span class="text-danger">*</span></label>
                            <textarea name="konten" rows="15" class="form-control @error('konten') is-invalid @enderror" required>{{ old('konten') }}</textarea>
                            @error('konten')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                {{-- Gambar Utama --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-semibold">
                            <i class="fas fa-image me-2 text-success"></i>Gambar Utama
                        </h5>
                    </div>
                    <div class="card-body">
                        {{-- Preview dengan tombol X --}}
                        <div id="image-preview" class="mb-3 d-none position-relative">
                            <img src="" alt="Preview" class="img-thumbnail w-100" style="max-height: 400px; object-fit: cover;">
                            <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2" onclick="removeImagePreview()">
                                <i class="fas fa-times"></i> Hapus
                            </button>
                        </div>
                        
                        <input type="file" name="gambar_utama" id="gambar_utama" class="form-control mb-2" accept="image/*">
                        <small class="text-muted">Format: JPG, PNG (Max 5MB) | Rekomendasi: 1200x630px</small>
                        
                        <div class="mt-3">
                            <label class="form-label fw-semibold">Caption Gambar</label>
                            <input type="text" name="caption_gambar" class="form-control" 
                                   value="{{ old('caption_gambar') }}" placeholder="Sumber foto atau keterangan">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="col-lg-4">
                
                {{-- Publish --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-semibold">
                            <i class="fas fa-calendar-check me-2 text-warning"></i>Publikasi
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                <option value="Draft" {{ old('status') == 'Draft' ? 'selected' : '' }}>Draft</option>
                                <option value="Published" {{ old('status') == 'Published' ? 'selected' : '' }}>Published</option>
                            </select>
                            @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tanggal Publikasi <span class="text-danger">*</span></label>
                            <input type="datetime-local" name="tanggal_publish" class="form-control @error('tanggal_publish') is-invalid @enderror" 
                                   value="{{ old('tanggal_publish', now()->format('Y-m-d\TH:i')) }}" required>
                            @error('tanggal_publish')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                {{-- Kategori --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-semibold">
                            <i class="fas fa-folder me-2 text-info"></i>Kategori
                        </h5>
                    </div>
                    <div class="card-body">
                        <select name="id_kategori" class="form-select @error('id_kategori') is-invalid @enderror" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id_kategori }}" {{ old('id_kategori') == $kategori->id_kategori ? 'selected' : '' }}>
                                    {{ $kategori->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_kategori')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                {{-- Submit --}}
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-dark btn-lg">
                        <i class="fas fa-save me-2"></i>Simpan Berita
                    </button>
                    <button type="submit" name="status" value="Draft" class="btn btn-outline-secondary">
                        <i class="fas fa-file me-2"></i>Simpan sebagai Draft
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
.form-control, .form-select { border-radius: 8px; }
</style>
@endpush

@push('scripts')
<script>
const fileInput = document.getElementById('gambar_utama');
const preview = document.getElementById('image-preview');

// Preview image when selected
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

// Remove preview and reset file input
function removeImagePreview() {
    preview.classList.add('d-none');
    preview.querySelector('img').src = '';
    fileInput.value = ''; // Clear file input
}
</script>
@endpush
