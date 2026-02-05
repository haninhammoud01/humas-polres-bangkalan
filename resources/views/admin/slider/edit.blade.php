@extends('layouts.app')

@section('title', 'Edit Slider')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-warning text-dark">Edit Slider</div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.slider.update', $slider) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="fw-bold">Judul Slider</label>
                    <input type="text" name="judul" value="{{ $slider->judul }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="fw-bold">Link (Opsional)</label>
                    <input type="text" name="link" value="{{ $slider->link }}" class="form-control" placeholder="/berita/...">
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label>Urutan</label>
                        <input type="number" name="urutan" value="{{ $slider->urutan }}" class="form-control" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Status</label>
                        <select name="status" class="form-select" required>
                            <option value="Aktif" {{ $slider->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="Nonaktif" {{ $slider->status == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="fw-bold">Ganti Gambar (Opsional)</label>
                    <input type="file" name="gambar" class="form-control" accept="image/*">
                    <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar.</small>
                </div>

                <!-- Tampilkan Gambar Lama -->
                @if($slider->gambar)
                    <div class="mb-3">
                        <small>Gambar Sekarang:</small><br>
                        <img src="{{ asset('sliders/' . $slider->gambar) }}" alt="Gambar Lama" width="200" class="img-thumbnail">
                    </div>
                @endif

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Slider
                    </button>
                    <a href="{{ route('admin.slider.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection@extends('layouts.app')

@section('title', 'Edit Slider')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-warning text-dark">Edit Slider</div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.slider.update', $slider) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="fw-bold">Judul Slider</label>
                    <input type="text" name="judul" value="{{ $slider->judul }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="fw-bold">Link (Opsional)</label>
                    <input type="text" name="link" value="{{ $slider->link }}" class="form-control" placeholder="/berita/...">
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label>Urutan</label>
                        <input type="number" name="urutan" value="{{ $slider->urutan }}" class="form-control" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Status</label>
                        <select name="status" class="form-select" required>
                            <option value="Aktif" {{ $slider->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="Nonaktif" {{ $slider->status == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="fw-bold">Ganti Gambar (Opsional)</label>
                    <input type="file" name="gambar" class="form-control" accept="image/*">
                    <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar.</small>
                </div>

                <!-- Tampilkan Gambar Lama -->
                @if($slider->gambar)
                    <div class="mb-3">
                        <small>Gambar Sekarang:</small><br>
                        <img src="{{ asset('sliders/' . $slider->gambar) }}" alt="Gambar Lama" width="200" class="img-thumbnail">
                    </div>
                @endif

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Slider
                    </button>
                    <a href="{{ route('admin.slider.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
