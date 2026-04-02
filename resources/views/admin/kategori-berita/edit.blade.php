@extends('layouts.admin')

@section('title', 'Edit Kategori Berita')

@section('content')
<div class="container-fluid px-4">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold" style="color: #1a1a1a;">Edit Kategori</h2>
        <a href="{{ route('admin.kategori-berita.index') }}" class="btn btn-outline-dark">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    
                    <form action="{{ route('admin.kategori-berita.update', $kategori->id_kategori) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Nama Kategori --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold">
                                Nama Kategori <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('nama_kategori') is-invalid @enderror" 
                                   name="nama_kategori" 
                                   value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
                                   required>
                            @error('nama_kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Deskripsi --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold">
                                Deskripsi (Opsional)
                            </label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                      name="deskripsi" 
                                      rows="4">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Status Aktif --}}
                        <div class="mb-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" 
                                       type="checkbox" 
                                       name="is_active" 
                                       id="is_active"
                                       {{ old('is_active', $kategori->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold" for="is_active">
                                    Aktifkan Kategori
                                </label>
                            </div>
                        </div>

                        {{-- Submit --}}
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-dark px-4">
                                <i class="fas fa-save me-2"></i>Update Kategori
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
                        <i class="fas fa-info-circle me-2"></i>Info Kategori
                    </h6>
                </div>
                <div class="card-body">
                    <table class="table table-sm mb-0">
                        <tr>
                            <td class="fw-bold" width="40%">ID</td>
                            <td>{{ $kategori->id_kategori }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Slug</td>
                            <td><code>{{ $kategori->slug }}</code></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Jumlah Berita</td>
                            <td>
                                <span class="badge bg-primary">{{ $kategori->beritas->count() }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Dibuat</td>
                            <td>{{ $kategori->created_at->format('d M Y') }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Diupdate</td>
                            <td>{{ $kategori->updated_at->diffForHumans() }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            @if($kategori->beritas->count() > 0)
            <div class="alert alert-warning border-0 shadow-sm mt-3">
                <h6 class="alert-heading fw-bold">
                    <i class="fas fa-exclamation-triangle me-2"></i>Perhatian
                </h6>
                <p class="mb-0 small">
                    Kategori ini memiliki {{ $kategori->beritas->count() }} berita. 
                    Perubahan nama akan mempengaruhi semua berita terkait.
                </p>
            </div>
            @endif
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

.form-control:focus {
    border-color: #1a1a1a;
    box-shadow: 0 0 0 0.25rem rgba(26, 26, 26, 0.1);
}

.form-check-input:checked {
    background-color: #1a1a1a;
    border-color: #1a1a1a;
}
</style>
@endpush
