@extends('layouts.app')

@section('title', 'Tambah Berita')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="fas fa-pen-nib me-2"></i>Tulis Berita Baru</h4>
        </div>
        <div class="card-body">
            
            <form method="POST" action="{{ route('admin.berita.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <!-- Kolom Kiri (Input Utama) -->
                    <div class="col-md-8">
                        
                        <!-- Judul -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Judul Berita</label>
                            <input type="text" name="judul" class="form-control form-control-lg" required placeholder="Masukkan judul menarik...">
                        </div>

                        <!-- Ringkasan -->
                        <div class="mb-3">
                            <label class="form-label">Ringkasan (Teaser)</label>
                            <textarea name="ringkasan" class="form-control" rows="3" required placeholder="Ringkasan singkat berita (untuk tampilan kartu)..."></textarea>
                            <small class="text-muted">Akan muncul di halaman depan.</small>
                        </div>

                        <!-- Isi Konten (Narasi) -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Isi Berita (Narasi)</label>
                            <textarea name="konten" class="form-control" rows="15" required placeholder="Tulis narasi lengkap berita di sini..."></textarea>
                        </div>
                    </div>

                    <!-- Kolom Kanan (Pengaturan & Foto) -->
                    <div class="col-md-4">
                        
                        <div class="card bg-light mb-3">
                            <div class="card-body">
                                <h6 class="fw-bold mb-3">Pengaturan</h6>
                                
                                <!-- Kategori -->
                                <div class="mb-3">
                                    <label class="form-label">Kategori Berita</label>
                                    <select name="id_kategori" class="form-select" required>
                                        <option value="">-- Pilih Kategori --</option>
                                        @foreach($kategori as $kat)
                                            <option value="{{ $kat->id_kategori }}">{{ $kat->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Status -->
                                <div class="mb-3">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-select">
                                        <option value="Published">Published (Langsung Tayang)</option>
                                        <option value="Draft">Draft (Disimpan Dulu)</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Upload Gambar -->
                        <div class="card bg-light mb-3">
                            <div class="card-body">
                                <h6 class="fw-bold mb-3">Foto Utama</h6>
                                
                                <div class="mb-3">
                                    <input type="file" name="gambar_utama" class="form-control" accept="image/*" required>
                                </div>
                                <small class="text-muted d-block mb-2">Rekomendasi rasio 16:9 (Min 800px x 450px)</small>
                                
                                <!-- Preview Gambar (Optional JS) -->
                                <img id="preview-image" src="https://via.placeholder.com/400x225?text=Preview" class="img-fluid rounded shadow-sm" alt="Preview">
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Tombol Simpan -->
                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-success px-4">
                        <i class="fas fa-paper-plane"></i> Publish Berita
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<!-- Script Sederhana untuk Preview Gambar -->
<script>
    document.querySelector('input[name="gambar_utama"]').addEventListener('change', function(event){
        const file = event.target.files[0];
        if(file){
            document.getElementById('preview-image').src = URL.createObjectURL(file);
        }
    });
</script>
@endsection
