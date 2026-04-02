@extends('layouts.admin')

@section('title', 'Tambah Layanan')

@section('content')
<div class="container-fluid px-4">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1" style="color: #1a1a1a;">Tambah Layanan Baru</h2>
            <p class="text-muted mb-0">Tambahkan layanan kepolisian</p>
        </div>
        <a href="{{ route('admin.layanan.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>

    <form action="{{ route('admin.layanan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

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
                                   value="{{ old('nama_layanan') }}" required>
                            @error('nama_layanan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Deskripsi Singkat</label>
                            <textarea name="deskripsi_singkat" rows="2" class="form-control" 
                                      placeholder="Ringkasan singkat layanan (maks 500 karakter)">{{ old('deskripsi_singkat') }}</textarea>
                            <small class="text-muted">Ditampilkan di card preview</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Deskripsi Lengkap <span class="text-danger">*</span></label>
                            <textarea name="deskripsi" rows="5" class="form-control @error('deskripsi') is-invalid @enderror" required>{{ old('deskripsi') }}</textarea>
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
                            <textarea name="persyaratan" rows="4" class="form-control" 
                                      placeholder="Pisahkan setiap persyaratan dengan enter">{{ old('persyaratan') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Prosedur</label>
                            <textarea name="prosedur" rows="4" class="form-control" 
                                      placeholder="Langkah-langkah pengajuan layanan">{{ old('prosedur') }}</textarea>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Biaya</label>
                                <input type="text" name="biaya" class="form-control" 
                                       value="{{ old('biaya') }}" placeholder="Gratis / Rp 50.000">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Waktu Proses</label>
                                <input type="text" name="waktu_proses" class="form-control" 
                                       value="{{ old('waktu_proses') }}" placeholder="3 hari kerja">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Lokasi Pelayanan</label>
                                <input type="text" name="lokasi_pelayanan" class="form-control" 
                                       value="{{ old('lokasi_pelayanan') }}" placeholder="Loket 1, Lantai 1">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Kontak</label>
                                <input type="text" name="kontak" class="form-control" 
                                       value="{{ old('kontak') }}" placeholder="0812-3456-7890">
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
                        <div id="icon-preview" class="mb-3 text-center d-none">
                            <img src="" alt="Preview" class="img-thumbnail" style="max-width: 150px; max-height: 150px;">
                        </div>
                        <input type="file" name="icon_image" id="icon_image" class="form-control mb-2" accept="image/*">
                        <small class="text-muted">Format: PNG, SVG, JPG (Max 2MB)<br>Rekomendasi: 100x100px</small>
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
                               value="{{ old('urutan', 0) }}" min="0">
                        <small class="text-muted">Semakin kecil angka, semakin atas urutannya</small>
                    </div>
                </div>

                {{-- Submit --}}
                <div class="d-grid">
                    <button type="submit" class="btn btn-dark btn-lg">
                        <i class="fas fa-save me-2"></i>Simpan Layanan
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
// Preview icon before upload
document.getElementById('icon_image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('icon-preview');
            preview.querySelector('img').src = e.target.result;
            preview.classList.remove('d-none');
        };
        reader.readAsDataURL(file);
    }
});
</script>
@endpush
