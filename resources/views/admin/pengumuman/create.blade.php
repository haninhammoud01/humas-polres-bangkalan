@extends('layouts.admin')
@section('content')
<div class="container-fluid px-4">
    <h2 class="fw-bold mb-4">Tambah Pengumuman</h2>
    <form action="{{ route('admin.pengumuman.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm p-4 mb-4">
                    <div class="mb-3">
                        <label class="fw-bold">Judul *</label>
                        <input type="text" name="judul" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Konten *</label>
                        <textarea name="konten" class="form-control" rows="10" required></textarea>
                    </div>
                    <div class="mb-0">
                        <label class="fw-bold">Media</label>
                        <input type="file" name="media" class="form-control">
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm p-4 mb-4">
                    <div class="mb-3">
                        <label class="fw-bold">Tanggal</label>
                        <input type="date" name="tanggal_pengumuman" class="form-control" value="{{ date('Y-m-d') }}">
                    </div>
                    <div class="form-check form-switch mb-4">
                        <input class="form-check-input" type="checkbox" name="status" id="status" value="Aktif" checked>
                        <label class="form-check-label fw-bold" for="status">Tampilkan di Web</label>
                    </div>
                    <button type="submit" class="btn btn-dark w-100 py-3">Publish</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
