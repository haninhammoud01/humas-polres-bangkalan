@extends('layouts.app')

@section('title', 'Edit Pengumuman')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-warning text-dark">
            <h4 class="mb-0">Edit Pengumuman</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.pengumuman.update', $pengumuman) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-bold">Judul</label>
                    <input type="text" name="judul" value="{{ $pengumuman->judul }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Isi Pengumuman</label>
                    <textarea name="isi_pengumuman" class="form-control" rows="5" required>{{ $pengumuman->isi_pengumuman }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Prioritas</label>
                        <select name="prioritas" class="form-select" required>
                            <option value="Tinggi" {{ $pengumuman->prioritas == 'Tinggi' ? 'selected' : '' }}>Tinggi</option>
                            <option value="Sedang" {{ $pengumuman->prioritas == 'Sedang' ? 'selected' : '' }}>Sedang</option>
                            <option value="Rendah" {{ $pengumuman->prioritas == 'Rendah' ? 'selected' : '' }}>Rendah</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="Aktif" {{ $pengumuman->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="Nonaktif" {{ $pengumuman->status == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.pengumuman.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-warning text-white">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
