@extends('layouts.app')

@section('title', $album->nama_album)

@section('content')
<div class="container py-5">
    
    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('public.galeri.index') }}">Galeri</a></li>
            <li class="breadcrumb-item active">{{ $album->nama_album }}</li>
        </ol>
    </nav>

    {{-- Album Header --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-4">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h2 class="fw-bold mb-3">{{ $album->nama_album }}</h2>
                    
                    @if($album->deskripsi)
                    <p class="text-muted mb-3">{{ $album->deskripsi }}</p>
                    @endif

                    <div class="d-flex gap-3 text-muted">
                        <span>
                            <i class="far fa-calendar me-2"></i>
                            {{-- Perbaikan: Menggunakan Carbon::parse untuk menghindari error format() on string --}}
                            {{ $album->tanggal_dibuat ? \Carbon\Carbon::parse($album->tanggal_dibuat)->format('d F Y') : ($album->created_at ? $album->created_at->format('d F Y') : '-') }}
                        </span>
                        
                        @if($album->lokasi)
                        <span>
                            <i class="fas fa-map-marker-alt me-2"></i>
                            {{ $album->lokasi }}
                        </span>
                        @endif

                        <span>
                            <i class="fas fa-images me-2"></i>
                            {{ $album->photos->count() }} Foto
                        </span>
                    </div>
                </div>

                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                    @if($album->photos->count() > 0)
                    <a href="{{ route('public.galeri.download', $album->id_album) }}" 
                       class="btn btn-dark">
                        <i class="fas fa-download me-2"></i>Download Semua (ZIP)
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Photos Grid --}}
    @if($album->photos->count() > 0)
    <div class="row g-3">
        @foreach($album->photos as $index => $photo)
        <div class="col-md-3">
            <div class="photo-item" data-bs-toggle="modal" data-bs-target="#photoModal{{ $index }}">
                <div class="photo-wrapper">
                    {{-- file_path berisi URL Cloudinary langsung --}}
                    <img src="{{ $photo->file_path }}" 
                         alt="Photo {{ $index + 1 }}" 
                         class="img-fluid rounded">
                    <div class="photo-overlay">
                        <i class="fas fa-search-plus fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Photo Modal --}}
        <div class="modal fade" id="photoModal{{ $index }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content bg-transparent border-0">
                    <div class="modal-header border-0">
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-0">
                        <img src="{{ $photo->file_path }}" class="img-fluid w-100 rounded">
                        @if($photo->keterangan)
                        <div class="bg-dark text-white p-3 rounded-bottom">
                            <p class="mb-0">{{ $photo->keterangan }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @else
    {{-- Empty State --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body text-center py-5">
            <i class="fas fa-images fa-4x text-muted mb-3"></i>
            <h4 class="text-muted">Belum ada foto</h4>
            <p class="text-muted">Album ini belum memiliki foto</p>
        </div>
    </div>
    @endif

    {{-- Back Button --}}
    <div class="mt-4">
        <a href="{{ route('public.galeri.index') }}" class="btn btn-outline-dark">
            <i class="fas fa-arrow-left me-2"></i>Kembali ke Galeri
        </a>
    </div>

</div>
@endsection

@push('styles')
<style>
.photo-item {
    cursor: pointer;
    overflow: hidden;
    border-radius: 8px;
    position: relative;
}

.photo-wrapper {
    position: relative;
    overflow: hidden;
    border-radius: 8px;
}

.photo-wrapper img {
    transition: transform 0.3s ease;
    width: 100%;
    height: 250px;
    object-fit: cover;
}

.photo-item:hover .photo-wrapper img {
    transform: scale(1.1);
}

.photo-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
    color: white;
}

.photo-item:hover .photo-overlay {
    opacity: 1;
}

.modal-content {
    background: transparent !important;
}

.modal-body img {
    max-height: 80vh;
    object-fit: contain;
}

.btn-dark {
    background: #1a1a1a;
    border: none;
    transition: all 0.3s;
}

.btn-dark:hover {
    background: #dc3545;
    transform: translateY(-2px);
}

.breadcrumb {
    background: transparent;
    padding: 0;
}

.breadcrumb-item a {
    color: #666;
    text-decoration: none;
}

.breadcrumb-item a:hover {
    color: #dc3545;
}

.breadcrumb-item.active {
    color: #1a1a1a;
}
</style>
@endpush

@push('scripts')
<script>
// Navigasi keyboard untuk modal
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        const modals = document.querySelectorAll('.modal.show');
        modals.forEach(modal => {
            const bsModal = bootstrap.Modal.getInstance(modal);
            if (bsModal) bsModal.hide();
        });
    }
});
</script>
@endpush
