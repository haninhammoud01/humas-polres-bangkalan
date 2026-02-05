@extends('layouts.app')

@section('title', 'Upload Foto ke Album')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0"><i class="fas fa-camera-retro"></i> Upload Foto Galeri</h4>
        </div>
        <div class="card-body">
            
            <form method="POST" action="{{ route('admin.galeri-foto.store') }}" enctype="multipart/form-data">
                @csrf
                
                <div class="row">
                    <div class="col-md-8 mb-3">
                        <!-- Pilih Album Dropdown -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Pilih Album</label>
                            <select name="id_album" class="form-select" required>
                                <option value="">-- Pilih Album Terlebih Dahulu --</option>
                                @if($albums->count() > 0)
                                    @foreach($albums as $alb)
                                    <option value="{{ $alb->id_album }}">
                                        {{ $alb->nama_album }} ({{ $alb->fotos->count() }} Foto)
                                    </option>
                                    @endforeach
                                @else
                                    <option value="" disabled>Belum ada album. Buat album dulu.</option>
                                @endif
                            </select>
                        </div>

                        <!-- Input Banyak Foto -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Pilih Foto (Bisa Lebih Dari Satu)</label>
                            <input type="file" name="path_foto[]" class="form-control" multiple accept="image/*" required>
                            <small class="text-muted">Tekan Ctrl (atau Command) saat memilih file untuk memilih banyak.</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Deskripsi (Opsiional)</label>
                            <input type="text" name="deskripsi" class="form-control" placeholder="Tulisan deskripsi otomatis...">
                            <small class="text-muted">Deskripsi ini akan sama untuk semua foto yang dipilih.</small>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card bg-light p-3 border">
                            <h6 class="fw-bold"><i class="fas fa-info-circle text-primary"></i> Panduan Upload</h6>
                            <ul class="small text-muted">
                                <li>1. Pilih Album terlebih dahulu.</li>
                                <li>2. Klik tombol "Pilih File" -> Tekan Ctrl + A untuk memilih semua foto sekaligus.</li>
                                <li>3. Klik tombol "Upload Sekarang".</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-success w-100 btn-lg shadow-sm">
                    <i class="fas fa-upload"></i> Upload Sekarang
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
