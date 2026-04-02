@extends('layouts.app')

@section('title', 'Galeri Foto')

@section('content')
<div class="container py-5">
    {{-- Header --}}
    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold mb-3">Galeri Foto</h1>
        <p class="lead text-muted">Dokumentasi kegiatan Polres Bangkalan</p>
    </div>

    {{-- Album Grid --}}
    @if($albums->count() > 0)
    <div class="row g-4">
        @foreach($albums as $album)
        <div class="col-md-6 col-lg-4">
            <div class="card album-card h-100 border-0 shadow-sm">
                <div class="album-cover position-relative overflow-hidden" style="height: 250px;">
                    @if($album->cover_photo)
                        <img src="{{ $album->cover_photo }}" 
                             alt="{{ $album->nama_album }}" 
                             class="w-100 h-100 object-fit-cover">
                    @else
                        <div class="w-100 h-100 d-flex align-items-center justify-content-center bg-light">
                            <i class="fas fa-images fa-3x text-muted"></i>
                        </div>
                    @endif
                    
                    {{-- Photo Count Badge --}}
                    <div class="position-absolute top-0 end-0 m-3">
                        <span class="badge bg-dark bg-opacity-75">
                            <i class="fas fa-camera me-1"></i>
                            {{ $album->photos_count ?? 0 }} Foto
                        </span>
                    </div>
                </div>

                <div class="card-body">
                    <h5 class="card-title fw-bold mb-2">{{ $album->nama_album }}</h5>
                    
                    @if($album->deskripsi)
                        <p class="card-text text-muted small mb-3">
                            {{ Str::limit($album->deskripsi, 100) }}
                        </p>
                    @endif

                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted">
                            <i class="far fa-calendar me-1"></i>
                            @if($album->tanggal_dibuat)
                                @if(is_string($album->tanggal_dibuat))
                                    {{ \Carbon\Carbon::parse($album->tanggal_dibuat)->format('d M Y') }}
                                @else
                                    {{ $album->tanggal_dibuat->format('d M Y') }}
                                @endif
                            @else
                                {{ $album->created_at->format('d M Y') }}
                            @endif
                        </small>
                        
                        <a href="{{ route('public.galeri.show', $album->id_album) }}" 
                           class="btn btn-sm btn-dark">
                            Lihat Album
                            <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Pagination --}}
    @if($albums->hasPages())
    <div class="mt-5">
        {{ $albums->links() }}
    </div>
    @endif

    @else
    {{-- Empty State --}}
    <div class="text-center py-5">
        <i class="fas fa-images fa-4x text-muted mb-4"></i>
        <h4 class="text-muted">Belum Ada Album</h4>
        <p class="text-muted">Album foto akan ditampilkan di sini</p>
    </div>
    @endif
</div>
@endsection

@push('styles')
<style>
.album-card {
    transition: all 0.3s ease;
    border-radius: 12px;
    overflow: hidden;
}

.album-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 24px rgba(0,0,0,0.15) !important;
}

.album-cover {
    border-radius: 12px 12px 0 0;
}

.album-cover img {
    transition: transform 0.5s ease;
}

.album-card:hover .album-cover img {
    transform: scale(1.1);
}

.btn-dark {
    background: #1a1a1a;
    border: none;
    transition: all 0.3s;
}

.btn-dark:hover {
    background: #dc3545;
    transform: translateX(4px);
}
</style>
@endpush
