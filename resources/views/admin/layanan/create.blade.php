@extends('layouts.app')

@section('title', 'Tambah Layanan')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white">Form Tambah Layanan</div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.layanan.store') }}">
                @csrf

                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label class="fw-bold">Nama Layanan</label>
                            <input type="text" name="nama_layanan" class="form-control" placeholder="Contoh: Pembuatan SKCK" required>
                        </div>

                        <div class="mb-3">
                            <label class="fw-bold">Deskripsi Singkat</label>
                            <textarea name="deskripsi" class="form-control" rows="2" required placeholder="Deskripsi umum layanan..."></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="fw-bold">Persyaratan</label>
                            <textarea name="persyaratan" class="form-control" rows="4" required placeholder="1. KTP Asli..."></textarea>
                            <small class="text-muted">Gunakan baris baru untuk setiap poin.</small>
                        </div>

                        <div class="mb-3">
                            <label class="fw-bold">Prosedur</label>
                            <textarea name="prosedur" class="form-control" rows="4" required placeholder="1. Daftar..."></textarea>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card bg-light mb-3">
                            <div class="card-body">
                                <h6 class="fw-bold mb-3">Pengaturan</h6>

                                <div class="mb-3">
                                    <label>Waktu Layanan</label>
                                    <input type="text" name="waktu_layanan" class="form-control" value="Senin - Jumat: 08.00 - 14.00" required>
                                </div>

                                <div class="mb-3">
                                    <label>Biaya</label>
                                    <input type="text" name="biaya" class="form-control" value="Gratis" required>
                                </div>

                                <div class="mb-3">
                                    <label>Urutan Tampilan</label>
                                    <input type="number" name="urutan" class="form-control" value="0" required>
                                    <small class="text-muted">Angka kecil muncul duluan.</small>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success w-100">
                            <i class="fas fa-save"></i> Simpan Layanan
                        </button>
                        <a href="{{ route('admin.layanan.index') }}" class="btn btn-secondary w-100 mt-2">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
