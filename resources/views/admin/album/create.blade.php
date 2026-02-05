@extends('layouts.app')
@section('title', 'Buat Album')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white">Buat Album Kegiatan</div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.album.store') }}">
                @csrf
                <div class="mb-3">
                    <label class="fw-bold">Nama Album</label>
                    <input type="text" name="nama_album" class="form-control" required placeholder="Contoh: Operasi Zebra 2026">
                </div>
                <div class="mb-3">
                    <label class="fw-bold">Deskripsi Singkat</label>
                    <textarea name="deskripsi" class="form-control" rows="2" required placeholder="Kegiatan di Jalan Raya Bangkalan..."></textarea>
                </div>
                <button type="submit" class="btn btn-success">Simpan Album</button>
            </form>
        </div>
    </div>
</div>
@endsection
