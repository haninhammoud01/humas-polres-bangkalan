@extends('layouts.app')

@section('title', $berita->judul)

@section('content')
<div class="container py-5">
    
    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('berita.index') }}">Berita</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($berita->judul, 50) }}</li>
        </ol>
    </nav>

    <div class="row">
        {{-- Main Content --}}
        <div class="col-lg-8">
            <article class="berita-detail">
                
                {{-- Header --}}
                <div class="berita-header mb-4">
                    <div class="d-flex align-items-center gap-3 mb-3 flex-wrap">
                        <span class="badge bg-dark">{{ $berita->kategori->nama_kategori ?? 'Umum' }}</span>
                        <span class="text-muted">
                            <i class="far fa-calendar me-1"></i>
                            {{ $berita->tanggal_publish->translatedFormat('d F Y') }}
                        </span>
                        <span class="text-muted">
                            <i class="far fa-user me-1"></i>
                            {{ $berita->penulis->name ?? 'Admin' }}
                        </span>
                        <span class="text-muted">
                            <i class="far fa-eye me-1"></i>
                            {{ number_format($berita->views) }} views
                        </span>
                    </div>
                    <h1 class="fw-bold" style="color: #1a1a1a;">{{ $berita->judul }}</h1>
                </div>

                {{-- Featured Image --}}
                @if($berita->gambar_utama)
                <div class="berita-image mb-4">
                    {{-- ✅ PAKAI ACCESSOR gambar_utama_url --}}
                    <img src="{{ $berita->gambar_utama_url }}" 
                         alt="{{ $berita->judul }}"
                         class="img-fluid rounded shadow-sm"
                         style="width: 100%; max-height: 500px; object-fit: cover;"
                         onerror="this.src='{{ asset('assets/images/placeholder.jpg') }}'">
                    
                    @if($berita->caption_gambar)
                    <p class="text-muted small text-center mt-2 fst-italic">
                        {{ $berita->caption_gambar }}
                    </p>
                    @endif
                </div>
                @endif

                {{-- Content --}}
                <div class="berita-content">
                    {!! nl2br(e($berita->konten)) !!}
                </div>

                {{-- Share Buttons --}}
                <div class="berita-share mt-5 pt-4 border-top">
                    <h5 class="mb-3">Bagikan Berita:</h5>
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" 
                           class="btn btn-outline-primary btn-sm" 
                           target="_blank">
                            <i class="fab fa-facebook-f me-1"></i>Facebook
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($berita->judul) }}" 
                           class="btn btn-outline-dark btn-sm" 
                           target="_blank">
                            <i class="fab fa-x-twitter me-1"></i>X Twitter
                        </a>
                        <a href="https://wa.me/?text={{ urlencode($berita->judul . ' ' . url()->current()) }}" 
                           class="btn btn-outline-success btn-sm" 
                           target="_blank">
                            <i class="fab fa-whatsapp me-1"></i>WhatsApp
                        </a>
                        <button class="btn btn-outline-secondary btn-sm" onclick="copyUrl()">
                            <i class="fas fa-copy me-1"></i>Copy Link
                        </button>
                    </div>
                </div>

            </article>
        </div>

        {{-- Sidebar --}}
        <div class="col-lg-4">
            
            {{-- Berita Terkait --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-newspaper me-2"></i>Berita Terkait
                    </h5>
                </div>
                <div class="card-body p-0">
                    @if(isset($relatedBerita) && $relatedBerita->count() > 0)
                        @foreach($relatedBerita as $related)
                        <div class="related-item p-3 border-bottom">
                            <a href="{{ route('berita.show', $related->slug) }}" 
                               class="text-decoration-none">
                                <div class="d-flex gap-3">
                                    @if($related->gambar_utama)
                                    {{-- ✅ PAKAI ACCESSOR --}}
                                    <img src="{{ $related->gambar_utama_url }}" 
                                         alt="{{ $related->judul }}"
                                         style="width: 80px; height: 60px; object-fit: cover; border-radius: 8px;"
                                         onerror="this.src='{{ asset('assets/images/placeholder.jpg') }}'">
                                    @endif
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1" style="color: #1a1a1a;">
                                            {{ Str::limit($related->judul, 60) }}
                                        </h6>
                                        <small class="text-muted">
                                            {{ $related->tanggal_publish->diffForHumans() }}
                                        </small>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    @else
                        <div class="p-4 text-center text-muted">
                            <i class="fas fa-inbox fa-2x mb-2"></i>
                            <p class="mb-0">Tidak ada berita terkait</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Back Button --}}
            <a href="{{ route('berita.index') }}" class="btn btn-outline-dark w-100">
                <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar Berita
            </a>

        </div>
    </div>

</div>
@endsection

@push('styles')
<style>
.berita-detail {
    background: white;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.berita-content {
    font-size: 16px;
    line-height: 1.8;
    color: #333;
}

.berita-content p {
    margin-bottom: 1.2rem;
}

.breadcrumb {
    background: transparent;
    padding: 0;
}

.breadcrumb-item + .breadcrumb-item::before {
    content: "›";
    color: #999;
}

.breadcrumb-item a {
    color: #1a1a1a;
    text-decoration: none;
}

.breadcrumb-item a:hover {
    color: #dc3545;
}

.related-item {
    transition: background 0.2s;
}

.related-item:hover {
    background: #f8f9fa;
}

.related-item a {
    color: inherit;
}

.related-item a:hover h6 {
    color: #dc3545 !important;
}

.btn-outline-dark:hover {
    background: #1a1a1a;
    color: white;
}

/* Dark mode */
body.dark-mode .berita-detail {
    background: #2d2d2d;
}

body.dark-mode .berita-content {
    color: #e0e0e0;
}

body.dark-mode .related-item:hover {
    background: #3d3d3d;
}
</style>
@endpush

@push('scripts')
<script>
function copyUrl() {
    const url = window.location.href;
    navigator.clipboard.writeText(url).then(() => {
        alert('Link berhasil disalin!');
    }).catch(() => {
        alert('Gagal menyalin link');
    });
}
</script>
@endpush
