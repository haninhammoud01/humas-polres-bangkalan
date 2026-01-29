@extends('layouts.app')

@section('title', 'Edit Berita')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-warning text-dark">
            <h4 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Berita</h4>
        </div>
        <div class="card-body">
            
            <form method="POST" action="{{ route('admin.berita.update', $berita) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT') <!-- Penting: Untuk memberitahu Laravel ini proses Update -->

                <div class="row">
                    <!-- Kolom Kiri -->
                    <div class="col-md-8">
                        
                        <!-- Judul -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Judul Berita</label>
                            <input type="text" name="judul" value="{{ $berita->judul }}" class="form-control form-control-lg" required>
                        </div>

                        <!-- Ringkasan -->
                        <div class="mb-3">
                            <label class="form-label">Ringkasan</label>
                            <textarea name="ringkasan" class="form-control" rows="3" required>{{ $berita->ringkasan }}</textarea>
                        </div>

                        <!-- Isi Konten -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Isi Berita</label>
                            <textarea name="konten" class="form-control" rows="15" required>{{ $berita->konten }}</textarea>
                        </div>
                    </div>

                    <!-- Kolom Kanan -->
                    <div class="col-md-4">
                        
                        <div class="card bg-light mb-3">
                            <div class="card-body">
                                <h6 class="fw-bold mb-3">Pengaturan</h6>
                                
                                <!-- Kategori -->
                                <div class="mb-3">
                                    <label class="form-label">Kategori</label>
                                    <select name="id_kategori" class="form-select" required>
                                        <option value="">-- Pilih Kategori --</option>
                                        @foreach($kategori as $kat)
                                            {{-- Logic: Jika kategori == kategori berita, otomatis terpilih --}}
                                            <option value="{{ $kat->id_kategori }}" {{ $kat->id_kategori == $berita->id_kategori ? 'selected' : '' }}>
                                                {{ $kat->nama_kategori }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Status -->
                                <div class="mb-3">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-select">
                                        <option value="Published" {{ $berita->status == 'Published' ? 'selected' : '' }}>Published</option>
                                        <option value="Draft" {{ $berita->status == 'Draft' ? 'selected' : '' }}>Draft</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Gambar Utama -->
                        <div class="card bg-light mb-3">
                            <div class="card-body">
                                <h6 class="fw-bold mb-3">Foto Utama</h6>
                                
                                <div class="mb-3">
                                    <label class="form-label small">Ganti Foto (Opsional)</label>
                                    <input type="file" name="gambar_utama" class="form-control" accept="image/*">
                                </div>
                                
                                {{-- Tampilkan foto lama jika ada --}}
                                @if($berita->gambar_utama)
                                    <small class="text-muted d-block mb-2">Foto Saat Ini:</small>
                                    <img src="{{ asset('berita/' . $berita->gambar_utama) }}" class="img-fluid rounded shadow-sm mb-2" alt="Foto Lama">
                                @else
                                    <img src="https://via.placeholder.com/400x225?text=No+Image" class="img-fluid rounded shadow-sm mb-2">
                                @endif
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Tombol Simpan -->
                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-warning text-white px-4">
                        <i class="fas fa-save"></i> Update Perubahan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
