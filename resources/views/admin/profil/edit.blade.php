@extends('layouts.admin')

@section('title', 'Edit Profil Polres')

@section('content')
<div class="container-fluid px-4">
    
    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <p class="text-muted mb-0">Kelola informasi profil Polres Bangkalan</p>
        </div>
        <a href="{{ route('admin.profil.struktur') }}" class="btn btn-dark">
            <i class="fas fa-sitemap me-2"></i>Edit Struktur Organisasi
        </a>
    </div>

    {{-- Alert Messages --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- DEBUG INFO --}}
    @if(config('app.debug'))
    <div class="alert alert-info">
        <strong>DEBUG:</strong><br>
        Logo: {{ $profil->logo ?? 'null' }}<br>
        Logo URL: {{ $profil->logo_url ?? 'null' }}<br>
        Storage Link: {{ public_path('storage') }} → {{ storage_path('app/public') }}
    </div>
    @endif

    <form action="{{ route('admin.profil.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row g-4">
            {{-- Main Content --}}
            <div class="col-lg-8">
                
                {{-- Informasi Dasar --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-semibold">
                            <i class="fas fa-info-circle me-2 text-primary"></i>Informasi Dasar
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label fw-semibold">Nama Instansi <span class="text-danger">*</span></label>
                                <input type="text" name="nama_instansi" class="form-control @error('nama_instansi') is-invalid @enderror" 
                                       value="{{ old('nama_instansi', $profil->nama_instansi) }}" required>
                                @error('nama_instansi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-12">
                                <label class="form-label fw-semibold">Alamat <span class="text-danger">*</span></label>
                                <textarea name="alamat" rows="3" class="form-control @error('alamat') is-invalid @enderror" required>{{ old('alamat', $profil->alamat) }}</textarea>
                                @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Telepon</label>
                                <input type="text" name="telepon" class="form-control" value="{{ old('telepon', $profil->telepon) }}">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', $profil->email) }}">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Website</label>
                                <input type="url" name="website" class="form-control" value="{{ old('website', $profil->website) }}">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Visi Misi --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-semibold">
                            <i class="fas fa-bullseye me-2 text-success"></i>Visi & Misi
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Visi</label>
                            <textarea name="visi" rows="3" class="form-control">{{ old('visi', $profil->visi) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Misi</label>
                            <textarea name="misi" rows="5" class="form-control">{{ old('misi', $profil->misi) }}</textarea>
                            <small class="text-muted">Pisahkan dengan enter untuk beberapa poin</small>
                        </div>

                        <div>
                            <label class="form-label fw-semibold">Motto</label>
                            <input type="text" name="motto" class="form-control" value="{{ old('motto', $profil->motto) }}">
                        </div>
                    </div>
                </div>

                {{-- Sambutan Kapolres --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-semibold">
                            <i class="fas fa-user-tie me-2 text-info"></i>Sambutan Kapolres
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Nama Kapolres</label>
                                <input type="text" name="nama_kapolres" class="form-control" value="{{ old('nama_kapolres', $profil->nama_kapolres) }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold">Pangkat</label>
                                <input type="text" name="pangkat_kapolres" class="form-control" value="{{ old('pangkat_kapolres', $profil->pangkat_kapolres) }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold">NRP</label>
                                <input type="text" name="nrp_kapolres" class="form-control" value="{{ old('nrp_kapolres', $profil->nrp_kapolres) }}">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-semibold">Sambutan Kapolres</label>
                                <textarea name="sambutan_kapolres" rows="5" class="form-control">{{ old('sambutan_kapolres', $profil->sambutan_kapolres) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Wilayah Hukum --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-semibold">
                            <i class="fas fa-map-marked-alt me-2 text-danger"></i>Wilayah Hukum
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label fw-semibold">Deskripsi Wilayah</label>
                                <textarea name="wilayah_hukum" rows="3" class="form-control">{{ old('wilayah_hukum', $profil->wilayah_hukum) }}</textarea>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Luas Wilayah</label>
                                <input type="text" name="luas_wilayah" class="form-control" 
                                       value="{{ old('luas_wilayah', $profil->luas_wilayah) }}" placeholder="1.260,84 km²">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Jumlah Kecamatan</label>
                                <input type="number" name="jumlah_kecamatan" class="form-control" 
                                       value="{{ old('jumlah_kecamatan', $profil->jumlah_kecamatan) }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Jumlah Desa</label>
                                <input type="number" name="jumlah_desa" class="form-control" 
                                       value="{{ old('jumlah_desa', $profil->jumlah_desa) }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Sidebar - LOGO ONLY --}}
            <div class="col-lg-4">
                
                {{-- Logo --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-semibold">
                            <i class="fas fa-image me-2 text-warning"></i>Logo Polres
                        </h5>
                    </div>
                    <div class="card-body">
                        @if($profil->logo)
                        <div class="mb-3">
                            <img src="{{ asset('storage/' . $profil->logo) }}" alt="Logo" class="img-thumbnail w-100" style="max-height: 200px; object-fit: contain;">
                            <div class="text-muted small mt-1">
                                File: {{ basename($profil->logo) }}
                            </div>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="delete_logo" id="delete_logo" value="1">
                            <label class="form-check-label text-danger fw-semibold" for="delete_logo">
                                <i class="fas fa-trash me-1"></i>Hapus logo saat ini
                            </label>
                        </div>
                        @else
                        <div class="alert alert-warning mb-3">
                            <i class="fas fa-exclamation-triangle me-2"></i>Belum ada logo
                        </div>
                        @endif
                        
                        <label class="form-label fw-semibold">Upload Logo Baru</label>
                        <input type="file" name="logo" class="form-control mb-2" accept="image/*">
                        <small class="text-muted">Format: JPG, PNG, SVG (Max 2MB)</small>
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
