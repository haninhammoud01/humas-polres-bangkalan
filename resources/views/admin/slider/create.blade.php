@extends('layouts.app')
@section('title', 'Tambah Slider')
@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white">Upload Slider</div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.slider.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="fw-bold">Judul Slider</label>
                    <input type="text" name="judul" class="form-control" required placeholder="Contoh: Operasi Patuh 2026 Dimulai">
                </div>
                <div class="mb-3">
                    <label class="fw-bold">Link (Opsional)</label>
                    <input type="text" name="link" class="form-control" placeholder="/berita/operasi-patuh-2026">
                    <small class="text-muted">Tujuan kalau slider diklik.</small>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label>Urutan</label>
                        <input type="number" name="urutan" class="form-control" value="1" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Status</label>
                        <select name="status" class="form-select">
                            <option value="Aktif">Aktif</option>
                            <option value="Nonaktif">Nonaktif</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="fw-bold">Gambar (Landscape)</label>
                    <input type="file" name="gambar" class="form-control" accept="image/*" required>
                    <small class="text-muted d-block mt-1">Rekomendasi Ukuran: 1920px x 800px (16:9).</small>
                </div>
                <button type="submit" class="btn btn-primary">Upload Slider</button>
            </form>
        </div>
    </div>
</div>
@endsection
