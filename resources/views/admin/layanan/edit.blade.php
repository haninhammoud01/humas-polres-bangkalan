@extends('layouts.admin')

@section('title', 'Edit Layanan')

@section('content')
<div class="container-fluid px-4">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1" style="color: #1a1a1a;">Edit Layanan</h2>
            <p class="text-muted mb-0">{{ $layanan->nama_layanan }}</p>
        </div>
        <a href="{{ route('admin.layanan.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>

    <form action="{{ route('admin.layanan.update', $layanan->id_layanan) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row g-4">
            <div class="col-lg-8">
                
                {{-- Informasi Dasar --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-semibold">
                            <i class="fas fa-info-circle me-2 text-primary"></i>Informasi Dasar
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Layanan <span class="text-danger">*</span></label>
                            <input type="text" name="nama_layanan" class="form-control @error('nama_layanan') is-invalid @enderror" 
                                   value="{{ old('nama_layanan', $layanan->nama_layanan) }}" required>
                            @error('nama_layanan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Deskripsi Singkat</label>
                            <textarea name="deskripsi_singkat" rows="2" class="form-control">{{ old('deskripsi_singkat', $layanan->deskripsi_singkat) }}</textarea>
                            <small class="text-muted">Ditampilkan di card preview</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Deskripsi Lengkap <span class="text-danger">*</span></label>
                            <textarea name="deskripsi" rows="5" class="form-control @error('deskripsi') is-invalid @enderror" required>{{ old('deskripsi', $layanan->deskripsi) }}</textarea>
                            @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                {{-- Detail Layanan --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-semibold">
                            <i class="fas fa-clipboard-list me-2 text-success"></i>Detail Layanan
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Persyaratan</label>
                            <textarea name="persyaratan" rows="4" class="form-control">{{ old('persyaratan', $layanan->persyaratan) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Prosedur</label>
                            <textarea name="prosedur" rows="4" class="form-control">{{ old('prosedur', $layanan->prosedur) }}</textarea>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Biaya</label>
                                <input type="text" name="biaya" class="form-control" value="{{ old('biaya', $layanan->biaya) }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Waktu Proses</label>
                                <input type="text" name="waktu_proses" class="form-control" value="{{ old('waktu_proses', $layanan->waktu_proses) }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Lokasi Pelayanan</label>
                                <input type="text" name="lokasi_pelayanan" class="form-control" value="{{ old('lokasi_pelayanan', $layanan->lokasi_pelayanan) }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Kontak</label>
                                <input type="text" name="kontak" class="form-control" value="{{ old('kontak', $layanan->kontak) }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="col-lg-4">
                
                {{-- Icon --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-semibold">
                            <i class="fas fa-icons me-2 text-warning"></i>Icon Layanan
                        </h5>
                    </div>
                    <div class="card-body">
                        @if($layanan->icon_image)
                        <div class="mb-3 text-center">
                            <img src="{{ $layanan->icon_url }}" alt="Current Icon" class="img-thumbnail" style="max-width: 150px; max-height: 150px;">
                            <div class="text-muted small mt-1">
                                Current: {{ basename($layanan->icon_image) }}
                            </div>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="delete_icon" id="delete_icon" value="1">
                            <label class="form-check-label text-danger fw-semibold" for="delete_icon">
                                <i class="fas fa-trash me-1"></i>Hapus icon saat ini
                            </label>
                        </div>
                        @else
                        <div class="alert alert-warning mb-3">
                            <i class="fas fa-exclamation-triangle me-2"></i>Belum ada icon
                        </div>
                        @endif
                        
                        <label class="form-label fw-semibold">Upload Icon Baru</label>
                        <input type="file" name="icon_image" id="icon_image" class="form-control mb-2" accept="image/*">
                        <small class="text-muted">Format: PNG, SVG, JPG (Max 2MB)</small>
                    </div>
                </div>

                {{-- Urutan --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-semibold">
                            <i class="fas fa-sort-numeric-down me-2 text-info"></i>Urutan Tampil
                        </h5>
                    </div>
                    <div class="card-body">
                        <input type="number" name="urutan" class="form-control" 
                               value="{{ old('urutan', $layanan->urutan) }}" min="0">
                        <small class="text-muted">Semakin kecil angka, semakin atas urutannya</small>
                    </div>
                </div>

                {{-- Submit --}}
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-dark btn-lg">
                        <i class="fas fa-save me-2"></i>Update Layanan
                    </button>
                    <a href="{{ route('public.layanan.show', $layanan->slug) }}" class="btn btn-outline-secondary" target="_blank">
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
