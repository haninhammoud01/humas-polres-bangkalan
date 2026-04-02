@extends('layouts.app')

@section('title', 'Berita - Humas Polres Bangkalan')

@section('content')
<div class="container py-5">
    
    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">Berita</li>
        </ol>
    </nav>

    {{-- Header --}}
    <div class="text-center mb-5">
        <h1 class="fw-bold mb-2" style="color: #1a1a1a;">Berita</h1>
        <p class="text-muted">Berita terkini dari Humas Polres Bangkalan</p>
    </div>

    {{-- List Berita --}}
    <div class="row justify-content-center">
        <div class="col-md-10">
            @forelse($beritas as $berita)
            <div class="card shadow-sm mb-4 berita-card">
                <div class="row g-0">
                    {{-- Gambar --}}
                    @if($berita->gambar_utama)
                    <div class="col-md-4">
                        {{-- ✅ PAKAI ACCESSOR gambar_utama_url --}}
                        <img src="{{ $berita->gambar_utama_url }}" 
                             class="img-fluid h-100 berita-img" 
                             alt="{{ $berita->judul }}"
                             onerror="this.src='{{ asset('assets/images/placeholder.jpg') }}'">
                    </div>
                    @endif

                    {{-- Content --}}
                    <div class="{{ $berita->gambar_utama ? 'col-md-8' : 'col-md-12' }}">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                {{-- Kategori Badge --}}
                                <span class="badge bg-dark mb-2">
                                    {{ $berita->kategori->nama_kategori ?? 'Umum' }}
                                </span>
                                
                                {{-- Tanggal --}}
                                <small class="text-muted">
                                    <i class="far fa-calendar"></i>
                                    {{ $berita->tanggal_publish->format('d M Y') }}
                                </small>
                            </div>

                            {{-- Judul - Link ke Detail --}}
                            <h4 class="card-title fw-bold mb-3">
                                <a href="{{ route('berita.show', $berita->slug) }}" 
                                   class="text-decoration-none"
                                   style="color: #1a1a1a;">
                                    {{ $berita->judul }}
                                </a>
                            </h4>

                            {{-- Konten Preview --}}
                            <div class="card-text text-muted mb-3">
                                {{ Str::limit(strip_tags($berita->ringkasan ?? $berita->konten), 200) }}
                            </div>

                            {{-- Read More Button --}}
                            <a href="{{ route('berita.show', $berita->slug) }}" 
                               class="btn btn-dark btn-sm">
                                Baca Selengkapnya <i class="fas fa-arrow-right ms-1"></i>
                            </a>

                            {{-- Meta Info --}}
                            <div class="border-top mt-3 pt-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">
                                        <i class="fas fa-user"></i> 
                                        {{ $berita->penulis->name ?? 'Admin Humas' }}
                                    </small>
                                    <small class="text-muted">
                                        <i class="fas fa-eye"></i> 
                                        {{ number_format($berita->views) }} views
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center py-5">
                <i class="fas fa-newspaper fa-4x text-muted mb-3"></i>
                <h4 class="text-muted">Belum Ada Berita</h4>
                <p class="text-muted">Berita akan ditampilkan di sini</p>
            </div>
            @endforelse
        </div>
    </div>

    {{-- Pagination --}}
    @if($beritas->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $beritas->links() }}
        </div>
    @endif

</div>
@endsection

@push('styles')
<style>
.berita-card {
    border-radius: 12px;
    transition: all 0.3s;
    border: 1px solid #e0e0e0;
    overflow: hidden;
}

.berita-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.1) !important;
}

.berita-img {
    object-fit: cover;
    border-radius: 12px 0 0 12px;
    min-height: 250px;
}

.card-title a {
    transition: color 0.3s;
}

.card-title a:hover {
    color: #dc3545 !important;
}

.badge {
    font-size: 12px;
    padding: 6px 12px;
    border-radius: 20px;
}

.btn-dark {
    background: #1a1a1a;
    border: none;
    padding: 8px 20px;
    border-radius: 6px;
    transition: all 0.3s;
}

.btn-dark:hover {
    background: #dc3545;
    transform: translateX(3px);
}

.breadcrumb {
    background: transparent;
    padding: 0;
}

.breadcrumb-item a {
    color: #1a1a1a;
    text-decoration: none;
}

.breadcrumb-item a:hover {
    color: #dc3545;
}

/* Dark mode */
body.dark-mode .berita-card {
    background: #2d2d2d;
    border-color: #444;
}

body.dark-mode .card-title a {
    color: #fff !important;
}

body.dark-mode .card-title a:hover {
    color: #dc3545 !important;
}
</style>
@endpush
