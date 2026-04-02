@extends('layouts.admin') 

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-danger">
                    <h6 class="m-0 font-weight-bold text-white">Edit Pengumuman: {{ $pengumuman->judul }}</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.pengumuman.update', $pengumuman->id_pengumuman) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-8">
                                {{-- Judul --}}
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold">Judul Pengumuman</label>
                                    <input type="text" name="judul" class="form-control" value="{{ old('judul', $pengumuman->judul) }}" required>
                                </div>

                                {{-- Isi Teks --}}
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold">Isi Pengumuman</label>
                                    <textarea name="konten" class="form-control" rows="10" required>{{ old('konten', $pengumuman->isi_pengumuman) }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-4">
                                {{-- Media --}}
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold">Upload Media (Baru)</label>
                                    <input type="file" name="media" class="form-control">
                                    
                                    @if($pengumuman->media)
                                        <div class="mt-3 p-2 border rounded text-center bg-light">
                                            <p class="small text-muted mb-1">Preview Media Saat Ini:</p>
                                            <img src="{{ $pengumuman->media }}" class="img-fluid rounded" style="max-height: 200px;">
                                        </div>
                                    @endif
                                </div>

                                {{-- Tanggal --}}
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold">Tanggal</label>
                                    <input type="date" name="tanggal_pengumuman" class="form-control" 
                                           value="{{ date('Y-m-d', strtotime($pengumuman->tanggal)) }}">
                                </div>

                                {{-- Status --}}
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold d-block">Status Aktif</label>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" name="is_active" class="custom-control-input" id="customSwitch1" {{ $pengumuman->status == 'Aktif' ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="customSwitch1">Aktifkan Pengumuman</label>
                                    </div>
                                </div>

                                <hr>
                                <div class="btn-group w-100">
                                    <button type="submit" class="btn btn-danger shadow">
                                        <i class="fas fa-save"></i> Simpan Perubahan
                                    </button>
                                    <a href="{{ route('admin.pengumuman.index') }}" class="btn btn-secondary">Batal</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
