@extends('layouts.admin')

@section('title', 'Edit Berita')

@section('content')
<div class="container-fluid px-4">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1" style="color: #1a1a1a;">Edit Berita</h2>
            <p class="text-muted mb-0">{{ $berita->judul }}</p>
        </div>
        <a href="{{ route('admin.berita.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>

    <form action="{{ route('admin.berita.update', $berita->id_berita) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

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
                                   value="{{ old('judul', $berita->judul) }}" required>
                            @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Ringkasan</label>
                            <textarea name="ringkasan" rows="3" class="form-control">{{ old('ringkasan', $berita->ringkasan) }}</textarea>
                            <small class="text-muted">Ditampilkan di card preview dan meta description</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Konten Berita <span class="text-danger">*</span></label>
                            <textarea name="konten" rows="15" class="form-control @error('konten') is-invalid @enderror" required>{{ old('konten', $berita->konten) }}</textarea>
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
                        @if($berita->gambar_utama)
                        <div class="mb-3">
                            <img src="{{ $berita->gambar_utama_url }}" alt="Current" class="img-thumbnail w-100" style="max-height: 400px; object-fit: cover;">
                            <div class="text-muted small mt-1">
                                File: {{ basename($berita->gambar_utama) }}
                            </div>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="delete_gambar" id="delete_gambar" value="1">
                            <label class="form-check-label text-danger fw-semibold" for="delete_gambar">
                                <i class="fas fa-trash me-1"></i>Hapus gambar saat ini
                            </label>
                        </div>
                        @else
                        <div class="alert alert-warning mb-3">
                            <i class="fas fa-exclamation-triangle me-2"></i>Belum ada gambar utama
                        </div>
                        @endif
                        
                        <label class="form-label fw-semibold">Upload Gambar Baru</label>
                        <input type="file" name="gambar_utama" id="gambar_utama" class="form-control mb-2" accept="image/*">
                        <small class="text-muted">Format: JPG, PNG (Max 5MB) | Upload baru akan otomatis mengganti yang lama</small>
                        
                        <div class="mt-3">
                            <label class="form-label fw-semibold">Caption Gambar</label>
                            <input type="text" name="caption_gambar" class="form-control" 
                                   value="{{ old('caption_gambar', $berita->caption_gambar) }}">
                        </div>
                    </div>
                </div>

                {{-- Info --}}
                <div class="card border-0 shadow-sm mb-4 bg-light">
                    <div class="card-body">
                        <div class="row g-3 small text-muted">
                            <div class="col-md-4">
                                <i class="fas fa-user me-2"></i>
                                <strong>Penulis:</strong> {{ $berita->penulis->name ?? 'N/A' }}
                            </div>
                            <div class="col-md-4">
                                <i class="fas fa-eye me-2"></i>
                                <strong>Views:</strong> {{ number_format($berita->views) }}
                            </div>
                            <div class="col-md-4">
                                <i class="fas fa-clock me-2"></i>
                                <strong>Dibuat:</strong> {{ $berita->created_at->format('d M Y H:i') }}
                            </div>
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
                                <option value="Draft" {{ old('status', $berita->status) == 'Draft' ? 'selected' : '' }}>Draft</option>
                                <option value="Published" {{ old('status', $berita->status) == 'Published' ? 'selected' : '' }}>Published</option>
                            </select>
                            @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tanggal Publikasi <span class="text-danger">*</span></label>
                            <input type="datetime-local" name="tanggal_publish" class="form-control @error('tanggal_publish') is-invalid @enderror" 
                                   value="{{ old('tanggal_publish', $berita->tanggal_publish->format('Y-m-d\TH:i')) }}" required>
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
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id_kategori }}" {{ old('id_kategori', $berita->id_kategori) == $kategori->id_kategori ? 'selected' : '' }}>
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
                        <i class="fas fa-save me-2"></i>Update Berita
                    </button>
                    <a href="{{ route('berita.show', $berita->slug) }}" class="btn btn-outline-secondary" target="_blank">
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
.form-control, .form-select { border-radius: 8px; }
.form-check-input:checked {
    background-color: #dc3545;
    border-color: #dc3545;
}
</style>
@endpush
