@extends('layouts.app')

@section('title', 'Beranda - Polres Bangkalan')

@section('content')
<div class="container py-5">

    <!-- BLOCK PENGUMUMAN (DI TAMBAHKAN) -->
    @forelse($pengumumanTerbaru as $info)
    <div class="alert alert-{{ $info->prioritas == 'Tinggi' ? 'danger' : ($info->prioritas == 'Sedang' ? 'warning' : 'success') }} alert-dismissible fade show shadow-sm mb-4" role="alert">
        <h5 class="alert-heading fw-bold">
            <i class="fas fa-bullhorn me-2"></i> {{ $info->judul }}
        </h5>
        <p class="mb-2">{{ $info->isi_pengumuman }}</p>
        <hr>
        <small class="mb-0">Diposting: {{ $info->tanggal->format('d M Y, H:i') }}</small>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endforelse

    <!-- 1. HERO SECTION -->
    <div class="text-center mb-5">
        <div class="mb-4">
            <i class="fas fa-shield-alt fa-4x text-primary mb-3"></i>
        </div>
        <h1 class="display-4 fw-bold text-dark mb-3">
            POLRES BANGKALAN
        </h1>
        <p class="lead text-muted mb-4">
            Melayani dengan Hati, Melindungi dengan Nyali.<br>
            Website Resmi Humas Polres Bangkalan.
        </p>
        
        <div class="d-flex justify-content-center gap-3 mb-5">
            <a href="#" class="btn btn-primary px-4 shadow-sm">
                <i class="fas fa-phone-alt me-2"></i> Layanan Pengaduan
            </a>
            <a href="#" class="btn btn-outline-primary px-4 shadow-sm">
                <i class="fas fa-info-circle me-2"></i> Profil Polres
            </a>
        </div>
    </div>

    <!-- 2. BERITA TERKINI -->
    <section class="mb-5">
        <div class="d-flex justify-content-between align-items-end mb-4 border-bottom pb-2">
            <h3 class="fw-bold text-dark">
                <i class="fas fa-newspaper me-2 text-primary"></i>Berita Terkini
            </h3>
            <a href="#" class="btn btn-sm btn-outline-primary">Lihat Semua Berita <i class="fas fa-arrow-right"></i></a>
        </div>

        <div class="row g-4">
            @forelse($beritaTerbaru as $item)
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm hover-card">
                    <div style="height: 220px; overflow: hidden;" class="card-img-top bg-light">
                        @if($item->gambar_utama)
                            <img src="{{ asset('berita/' . $item->gambar_utama) }}" class="w-100 h-100 object-fit-cover" alt="{{ $item->judul }}">
                        @else
                            <div class="w-100 h-100 d-flex align-items-center justify-content-center bg-light text-muted">
                                <i class="fas fa-image fa-3x opacity-25"></i>
                            </div>
                        @endif
                    </div>
                    <div class="card-body d-flex flex-column">
                        <div class="mb-2">
                            <span class="badge bg-primary">{{ $item->kategori->nama_kategori }}</span>
                        </div>
                        <h5 class="card-title fw-bold mb-3">
                            <a href="{{ route('public.berita.show', $item->slug) }}" class="text-decoration-none text-dark stretched-link">
                                {{ Str::limit($item->judul, 55) }}
                            </a>
                        </h5>
                        <div class="mt-auto pt-2 border-top">
                            <small class="text-muted">
                                <i class="far fa-calendar-alt me-1"></i> {{ optional($item->tanggal_publish)->format('d F Y') }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-warning text-center">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    Belum ada berita yang diterbitkan.
                </div>
            </div>
            @endforelse
        </div>
    </section>

    <!-- 3. FITUR LAIN -->
    <section class="mb-5">
        <h3 class="fw-bold text-dark mb-4">
            <i class="fas fa-th-large me-2 text-primary"></i>Informasi & Layanan
        </h3>
        
        <div class="row g-4">
            <div class="col-md-4">
                <a href="#" class="text-decoration-none">
                    <div class="card h-100 border-0 shadow-sm hover-card text-center p-4">
                        <div class="mb-3"><i class="fas fa-images fa-3x text-success"></i></div>
                        <h5 class="fw-bold text-dark">Galeri Foto</h5>
                        <p class="text-muted small">Dokumentasi kegiatan operasional dan sosialisasi Polres Bangkalan.</p>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="#" class="text-decoration-none">
                    <div class="card h-100 border-0 shadow-sm hover-card text-center p-4">
                        <div class="mb-3"><i class="fas fa-bullhorn fa-3x text-warning"></i></div>
                        <h5 class="fw-bold text-dark">Pengumuman</h5>
                        <p class="text-muted small">Informasi penting, jadwal layanan, dan penutupan jalan terkini.</p>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="#" class="text-decoration-none">
                    <div class="card h-100 border-0 shadow-sm hover-card text-center p-4">
                        <div class="mb-3"><i class="fas fa-id-card fa-3x text-primary"></i></div>
                        <h5 class="fw-bold text-dark">Layanan Polres</h5>
                        <p class="text-muted small">Pembuatan SIM, SKCK, Laporan Kehilangan, dan Izin Keramaian.</p>
                    </div>
                </a>
            </div>
        </div>
    </section>

</div>
@endsection
