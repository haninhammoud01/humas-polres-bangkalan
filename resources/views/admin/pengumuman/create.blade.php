@extends('layouts.app')

@section('title', 'Buat Pengumuman')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-info text-white">Buat Pengumuman</div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.pengumuman.store') }}">
                @csrf
                <div class="mb-3">
                    <label>Judul</label>
                    <input type="text" name="judul" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Isi</label>
                    <textarea name="isi_pengumuman" class="form-control" rows="3" required></textarea>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Prioritas</label>
                        <select name="prioritas" class="form-select">
                            <option value="Tinggi">Tinggi</option>
                            <option value="Sedang" selected>Sedang</option>
                            <option value="Rendah">Rendah</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Status</label>
                        <select name="status" class="form-select">
                            <option value="Aktif">Aktif (Tampil)</option>
                            <option value="Nonaktif">Nonaktif</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Terbitkan</button>
            </form>
        </div>
    </div>
</div>
@endsection
