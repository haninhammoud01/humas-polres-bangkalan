@extends('layouts.admin')

@section('title', 'Tambah Menu')

@section('content')
<div class="container-fluid px-4">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Tambah Menu Baru</h2>
        <a href="{{ route('admin.menu.index') }}" class="btn btn-outline-dark">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    
                    <form action="{{ route('admin.menu.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label class="form-label fw-bold">
                                Nama Menu <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('nama_menu') is-invalid @enderror" 
                                   name="nama_menu" 
                                   value="{{ old('nama_menu') }}"
                                   placeholder="Contoh: Tentang Kami"
                                   required>
                            @error('nama_menu')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">
                                URL <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('url') is-invalid @enderror" 
                                   name="url" 
                                   value="{{ old('url') }}"
                                   placeholder="/profil atau https://example.com"
                                   required>
                            @error('url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Path relatif (/profil) atau URL lengkap</small>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Icon (Font Awesome)</label>
                            <input type="text" 
                                   class="form-control @error('icon') is-invalid @enderror" 
                                   name="icon" 
                                   value="{{ old('icon') }}"
                                   placeholder="fa-home">
                            @error('icon')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">
                                Lihat icons di <a href="https://fontawesome.com/icons" target="_blank">fontawesome.com</a>
                            </small>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold">
                                    Urutan <span class="text-danger">*</span>
                                </label>
                                <input type="number" 
                                       class="form-control @error('urutan') is-invalid @enderror" 
                                       name="urutan" 
                                       value="{{ old('urutan', 1) }}"
                                       min="0"
                                       required>
                                @error('urutan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold">Target</label>
                                <select class="form-select" name="target">
                                    <option value="_self" {{ old('target') == '_self' ? 'selected' : '' }}>Same Tab (_self)</option>
                                    <option value="_blank" {{ old('target') == '_blank' ? 'selected' : '' }}>New Tab (_blank)</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" 
                                       type="checkbox" 
                                       name="is_active" 
                                       id="is_active"
                                       {{ old('is_active', true) ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold" for="is_active">
                                    Aktifkan Menu
                                </label>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-dark px-4">
                                <i class="fas fa-save me-2"></i>Simpan Menu
                            </button>
                            <a href="{{ route('admin.menu.index') }}" class="btn btn-light px-4">
                                Batal
                            </a>
                        </div>

                    </form>

                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <h6 class="mb-0 fw-bold">
                        <i class="fas fa-info-circle me-2"></i>Panduan
                    </h6>
                </div>
                <div class="card-body">
                    <p class="small mb-2"><strong>Contoh URL:</strong></p>
                    <ul class="small">
                        <li><code>/profil</code> - Page internal</li>
                        <li><code>/berita</code> - Page internal</li>
                        <li><code>https://example.com</code> - External link</li>
                    </ul>

                    <p class="small mb-2 mt-3"><strong>Contoh Icon:</strong></p>
                    <ul class="small">
                        <li><code>fa-home</code> <i class="fas fa-home"></i></li>
                        <li><code>fa-newspaper</code> <i class="fas fa-newspaper"></i></li>
                        <li><code>fa-images</code> <i class="fas fa-images"></i></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
