@extends('layouts.admin')

@section('title', 'Edit Album Foto')

@section('content')
<div class="container-fluid px-4">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1" style="color: #1a1a1a;">Edit Album Foto</h2>
            <p class="text-muted mb-0">{{ $album->nama_album }}</p>
        </div>
        <a href="{{ route('admin.album.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>

    <form action="{{ route('admin.album.update', $album->id_album) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row g-4">
            <div class="col-lg-8">
                
                {{-- Info Album --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-semibold">
                            <i class="fas fa-images me-2 text-primary"></i>Informasi Album
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Album <span class="text-danger">*</span></label>
                            <input type="text" name="nama_album" class="form-control @error('nama_album') is-invalid @enderror" 
                                   value="{{ old('nama_album', $album->nama_album) }}" required>
                            @error('nama_album')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Deskripsi</label>
                            <textarea name="deskripsi" rows="4" class="form-control">{{ old('deskripsi', $album->deskripsi) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tanggal Dibuat <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_dibuat" class="form-control @error('tanggal_dibuat') is-invalid @enderror" 
                                   value="{{ old('tanggal_dibuat', $album->tanggal_dibuat ? $album->tanggal_dibuat->format('Y-m-d') : date('Y-m-d')) }}" required>
                            @error('tanggal_dibuat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                {{-- Foto-foto yang Ada --}}
                @if($album->photos && $album->photos->count() > 0)
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-semibold">
                            <i class="fas fa-images me-2 text-info"></i>Foto dalam Album ({{ $album->photos->count() }})
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            @foreach($album->photos as $index => $photo)
                            <div class="col-md-3" id="photo-{{ $photo->id_foto }}">
                                <div class="position-relative">
                                    <img src="{{ $photo->file_url }}" alt="Photo" class="img-thumbnail w-100" style="height: 150px; object-fit: cover;">
                                    @if($index === 0)
                                    <span class="badge bg-primary position-absolute top-0 start-0 m-2">Cover</span>
                                    @endif
                                    <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 m-2" 
                                            onclick="deletePhoto({{ $album->id_album }}, {{ $photo->id_foto }})">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    <div class="small text-muted mt-1">
                                        {{ basename($photo->file_path) }}
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

                {{-- Tambah Foto Baru --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-semibold">
                            <i class="fas fa-plus-circle me-2 text-success"></i>Tambah Foto Baru
                        </h5>
                    </div>
                    <div class="card-body">
                        <input type="file" name="photos[]" id="new-photos" class="form-control" accept="image/*" multiple>
                        <small class="text-muted">Pilih foto baru untuk ditambahkan ke album</small>
                        
                        <div id="new-photo-preview" class="row g-3 mt-3"></div>
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="col-lg-4">
                
                {{-- Stats --}}
                <div class="card border-0 shadow-sm mb-4 bg-light">
                    <div class="card-body">
                        <h6 class="fw-semibold mb-3">
                            <i class="fas fa-chart-bar me-2"></i>Statistik Album
                        </h6>
                        <div class="row g-3 small">
                            <div class="col-6">
                                <div class="text-muted">Total Foto</div>
                                <div class="fw-bold h5 mb-0">{{ $album->photos->count() }}</div>
                            </div>
                            <div class="col-6">
                                <div class="text-muted">Dibuat</div>
                                <div class="fw-semibold">{{ $album->created_at->format('d M Y') }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Submit --}}
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-dark btn-lg">
                        <i class="fas fa-save me-2"></i>Update Album
                    </button>
                    <a href="{{ route('public.galeri.show', $album->id_album) }}" class="btn btn-outline-secondary" target="_blank">
                        <i class="fas fa-eye me-2"></i>Lihat Halaman Publik
                    </a>
                </div>
            </div>
        </div>
    </form>

</div>
@endsection

@push('styles')
<style>
.card { border-radius: 12px; }
.btn-dark {
    background: #1a1a1a !important;
    border: none !important;
    transition: all 0.3s;
}
.btn-dark:hover {
    background: #dc3545 !important;
    transform: translateY(-2px);
}
.form-control { border-radius: 8px; }
</style>
@endpush

@push('scripts')
<script>
// Delete photo via AJAX alternative: Form submission
function deletePhoto(albumId, photoId) {
    if (!confirm('Yakin ingin menghapus foto ini?')) return;
    
    // Create form
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = `/admin/album/${albumId}/photo/${photoId}`;
    
    // CSRF token
    const csrf = document.createElement('input');
    csrf.type = 'hidden';
    csrf.name = '_token';
    csrf.value = '{{ csrf_token() }}';
    form.appendChild(csrf);
    
    // Method DELETE
    const method = document.createElement('input');
    method.type = 'hidden';
    method.name = '_method';
    method.value = 'DELETE';
    form.appendChild(method);
    
    document.body.appendChild(form);
    form.submit();
}

// Preview new photos
document.getElementById('new-photos').addEventListener('change', function(e) {
    const preview = document.getElementById('new-photo-preview');
    preview.innerHTML = '';
    
    const files = Array.from(e.target.files);
    
    files.forEach((file) => {
        const reader = new FileReader();
        reader.onload = function(e) {
            const col = document.createElement('div');
            col.className = 'col-md-4';
            col.innerHTML = `
                <div>
                    <img src="${e.target.result}" class="img-thumbnail w-100" style="height: 150px; object-fit: cover;">
                    <div class="small text-muted mt-1">${file.name}</div>
                </div>
            `;
            preview.appendChild(col);
        };
        reader.readAsDataURL(file);
    });
});
</script>
@endpush
