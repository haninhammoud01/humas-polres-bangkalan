@extends('layouts.admin')

@section('title', isset($layanan) ? 'Edit Layanan' : 'Tambah Layanan')

@section('content')
<div class="container-fluid px-4">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold" style="color: #1a1a1a;">
            {{ isset($layanan) ? 'Edit Layanan' : 'Tambah Layanan' }}
        </h2>
        <a href="{{ route('admin.layanan.index') }}" class="btn btn-outline-dark">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>

    <form action="{{ isset($layanan) ? route('admin.layanan.update', $layanan->id_layanan) : route('admin.layanan.store') }}" 
          method="POST" 
          enctype="multipart/form-data">
        @csrf
        @if(isset($layanan))
            @method('PUT')
        @endif

        <div class="row">
            {{-- Main Form --}}
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        
                        {{-- Nama Layanan --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold">
                                Nama Layanan <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('nama_layanan') is-invalid @enderror" 
                                   name="nama_layanan" 
                                   value="{{ old('nama_layanan', $layanan->nama_layanan ?? '') }}"
                                   required>
                            @error('nama_layanan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Slug --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold">
                                Slug <small class="text-muted">(otomatis dari nama)</small>
                            </label>
                            <input type="text" 
                                   class="form-control @error('slug') is-invalid @enderror" 
                                   name="slug" 
                                   value="{{ old('slug', $layanan->slug ?? '') }}">
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Deskripsi Singkat --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold">Deskripsi Singkat</label>
                            <input type="text" 
                                   class="form-control @error('deskripsi') is-invalid @enderror" 
                                   name="deskripsi" 
                                   value="{{ old('deskripsi', $layanan->deskripsi ?? '') }}"
                                   placeholder="Contoh: Surat Keterangan Catatan Kepolisian">
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Informasi Umum --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold">Informasi Umum</label>
                            <textarea class="form-control @error('informasi_umum') is-invalid @enderror" 
                                      name="informasi_umum" 
                                      rows="4">{{ old('informasi_umum', $layanan->informasi_umum ?? '') }}</textarea>
                            @error('informasi_umum')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Persyaratan --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold">Persyaratan</label>
                            <textarea class="form-control @error('persyaratan') is-invalid @enderror" 
                                      name="persyaratan" 
                                      rows="6"
                                      placeholder="Pisahkan dengan enter/baris baru">{{ old('persyaratan', $layanan->persyaratan ?? '') }}</textarea>
                            @error('persyaratan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Contoh:<br>1. Fotokopi KTP<br>2. Pas foto 4x6</small>
                        </div>

                        {{-- Prosedur --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold">Prosedur/Langkah-langkah</label>
                            <textarea class="form-control @error('prosedur') is-invalid @enderror" 
                                      name="prosedur" 
                                      rows="6">{{ old('prosedur', $layanan->prosedur ?? '') }}</textarea>
                            @error('prosedur')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Catatan --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold">Catatan Penting</label>
                            <textarea class="form-control @error('catatan') is-invalid @enderror" 
                                      name="catatan" 
                                      rows="3">{{ old('catatan', $layanan->catatan ?? '') }}</textarea>
                            @error('catatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="col-lg-4">
                
                {{-- Detail Layanan --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-bottom">
                        <h6 class="mb-0 fw-bold">Detail Layanan</h6>
                    </div>
                    <div class="card-body">
                        
                        {{-- Jam Operasional --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Jam Operasional</label>
                            <textarea class="form-control @error('jam_operasional') is-invalid @enderror" 
                                      name="jam_operasional" 
                                      rows="3">{{ old('jam_operasional', $layanan->jam_operasional ?? '') }}</textarea>
                            @error('jam_operasional')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Biaya --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Biaya</label>
                            <input type="text" 
                                   class="form-control @error('biaya') is-invalid @enderror" 
                                   name="biaya" 
                                   value="{{ old('biaya', $layanan->biaya ?? '') }}"
                                   placeholder="Contoh: Rp 30.000">
                            @error('biaya')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Lokasi --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Lokasi</label>
                            <textarea class="form-control @error('lokasi') is-invalid @enderror" 
                                      name="lokasi" 
                                      rows="2">{{ old('lokasi', $layanan->lokasi ?? '') }}</textarea>
                            @error('lokasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Kontak --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Kontak</label>
                            <input type="text" 
                                   class="form-control @error('kontak') is-invalid @enderror" 
                                   name="kontak" 
                                   value="{{ old('kontak', $layanan->kontak ?? '') }}"
                                   placeholder="Contoh: 031-123456">
                            @error('kontak')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                </div>

                {{-- Icon & Settings --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-bottom">
                        <h6 class="mb-0 fw-bold">Icon & Pengaturan</h6>
                    </div>
                    <div class="card-body">
                        
                        {{-- Icon --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Icon (Font Awesome)</label>
                            <input type="text" 
                                   class="form-control @error('icon') is-invalid @enderror" 
                                   name="icon" 
                                   value="{{ old('icon', $layanan->icon ?? '') }}"
                                   placeholder="fa-id-card">
                            @error('icon')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">
                                Lihat icon: <a href="https://fontawesome.com/icons" target="_blank">FontAwesome</a>
                            </small>
                        </div>

                        {{-- Gambar --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Gambar (Opsional)</label>
                            <input type="file" 
                                   class="form-control @error('gambar') is-invalid @enderror" 
                                   name="gambar"
                                   accept="image/*">
                            @error('gambar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @if(isset($layanan) && $layanan->gambar)
                                <div class="mt-2">
                                    <img src="{{ $layanan->gambar }}" class="img-thumbnail" style="max-height: 100px;">
                                </div>
                            @endif
                        </div>

                        {{-- Urutan --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Urutan Tampilan</label>
                            <input type="number" 
                                   class="form-control @error('urutan') is-invalid @enderror" 
                                   name="urutan" 
                                   value="{{ old('urutan', $layanan->urutan ?? 0) }}"
                                   min="0">
                            @error('urutan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Status Aktif --}}
                        <div class="form-check">
                            <input class="form-check-input" 
                                   type="checkbox" 
                                   name="is_active" 
                                   id="is_active"
                                   value="1"
                                   {{ old('is_active', $layanan->is_active ?? true) ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold" for="is_active">
                                Aktif
                            </label>
                        </div>

                    </div>
                </div>

                {{-- Submit Button --}}
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-dark btn-lg">
                        <i class="fas fa-save me-2"></i>
                        {{ isset($layanan) ? 'Update Layanan' : 'Simpan Layanan' }}
                    </button>
                    <a href="{{ route('admin.layanan.index') }}" class="btn btn-light btn-lg">
                        Batal
                    </a>
                </div>

            </div>
        </div>
    </form>

</div>
@endsection

@push('styles')
<style>
.btn-dark {
    background: #1a1a1a !important;
    border-color: #1a1a1a !important;
    transition: all 0.3s;
}
.btn-dark:hover {
    background: #dc3545 !important;
    border-color: #dc3545 !important;
    transform: translateY(-2px);
}
.card {
    border-radius: 12px;
}
.form-control:focus, .form-select:focus {
    border-color: #1a1a1a;
    box-shadow: 0 0 0 0.25rem rgba(26, 26, 26, 0.1);
}
</style>
@endpush
