@extends('layouts.app')

@section('title', 'Edit Layanan')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-warning text-dark">Form Edit Layanan</div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.layanan.update', $layanan) }}">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label class="fw-bold">Nama Layanan</label>
                            <input type="text" name="nama_layanan" value="{{ $layanan->nama_layanan }}" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="fw-bold">Deskripsi Singkat</label>
                            <textarea name="deskripsi" class="form-control" rows="2" required>{{ $layanan->deskripsi }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="fw-bold">Persyaratan</label>
                            <textarea name="persyaratan" class="form-control" rows="4" required>{{ $layanan->persyaratan }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="fw-bold">Prosedur</label>
                            <textarea name="prosedur" class="form-control" rows="4" required>{{ $layanan->prosedur }}</textarea>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card bg-light mb-3">
                            <div class="card-body">
                                <h6 class="fw-bold mb-3">Pengaturan</h6>

                                <div class="mb-3">
                                    <label>Waktu Layanan</label>
                                    <input type="text" name="waktu_layanan" value="{{ $layanan->waktu_layanan }}" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label>Biaya</label>
                                    <input type="text" name="biaya" value="{{ $layanan->biaya }}" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label>Urutan Tampilan</label>
                                    <input type="number" name="urutan" value="{{ $layanan->urutan }}" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-warning text-dark w-100">
                            <i class="fas fa-save"></i> Update Perubahan
                        </button>
                        <a href="{{ route('admin.layanan.index') }}" class="btn btn-secondary w-100 mt-2">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
