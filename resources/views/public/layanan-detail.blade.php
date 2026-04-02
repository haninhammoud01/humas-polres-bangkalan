@extends('layouts.app')

@section('title', $layanan->nama_layanan)

@section('content')
<div class="container py-5">
    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('public.layanan.index') }}">Layanan</a></li>
            <li class="breadcrumb-item active">{{ $layanan->nama_layanan }}</li>
        </ol>
    </nav>

    <div class="row g-5">
        {{-- Main Content --}}
        <div class="col-lg-8">
            <div class="layanan-detail">
                {{-- Header with Icon --}}
                <div class="d-flex align-items-center gap-4 mb-4">
                    @if($layanan->icon_image)
                    <div class="layanan-icon-large flex-shrink-0">
                        <img src="{{ asset($layanan->icon_image) }}" 
                             alt="{{ $layanan->nama_layanan }}" 
                             class="img-fluid"
                             style="max-height: 100px; width: auto;">
                    </div>
                    @endif
                    <div>
                        <h1 class="display-6 fw-bold mb-2">{{ $layanan->nama_layanan }}</h1>
                        @if($layanan->deskripsi_singkat)
                            <p class="lead text-muted mb-0">{{ $layanan->deskripsi_singkat }}</p>
                        @endif
                    </div>
                </div>

                {{-- Description --}}
                @if($layanan->deskripsi)
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3">
                            <i class="fas fa-info-circle text-primary me-2"></i>
                            Tentang Layanan
                        </h5>
                        <p class="mb-0">{{ $layanan->deskripsi }}</p>
                    </div>
                </div>
                @endif

                {{-- Persyaratan --}}
                @if($layanan->persyaratan)
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3">
                            <i class="fas fa-clipboard-list text-success me-2"></i>
                            Persyaratan
                        </h5>
                        <div class="requirements">
                            {!! nl2br(e($layanan->persyaratan)) !!}
                        </div>
                    </div>
                </div>
                @endif

                {{-- Prosedur --}}
                @if($layanan->prosedur)
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3">
                            <i class="fas fa-list-ol text-info me-2"></i>
                            Prosedur
                        </h5>
                        <div class="procedure">
                            {!! nl2br(e($layanan->prosedur)) !!}
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>

        {{-- Sidebar --}}
        <div class="col-lg-4">
            {{-- Quick Info --}}
            <div class="card border-0 shadow-sm sticky-top" style="top: 100px;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">Informasi Singkat</h5>

                    @if($layanan->biaya)
                    <div class="info-item mb-3">
                        <div class="d-flex align-items-start gap-3">
                            <i class="fas fa-money-bill-wave text-success mt-1"></i>
                            <div>
                                <strong class="d-block mb-1">Biaya</strong>
                                <span class="text-muted">{{ $layanan->biaya }}</span>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($layanan->waktu_proses)
                    <div class="info-item mb-3">
                        <div class="d-flex align-items-start gap-3">
                            <i class="fas fa-clock text-warning mt-1"></i>
                            <div>
                                <strong class="d-block mb-1">Waktu Proses</strong>
                                <span class="text-muted">{{ $layanan->waktu_proses }}</span>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="info-item mb-3">
                        <div class="d-flex align-items-start gap-3">
                            <i class="fas fa-map-marker-alt text-danger mt-1"></i>
                            <div>
                                <strong class="d-block mb-1">Lokasi</strong>
                                <span class="text-muted">Polres Bangkalan<br>Jl. Soekarno Hatta No.45</span>
                            </div>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="d-flex align-items-start gap-3">
                            <i class="fas fa-phone text-primary mt-1"></i>
                            <div>
                                <strong class="d-block mb-1">Kontak</strong>
                                <span class="text-muted">(031) 3095266</span>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-grid gap-2">
                        <a href="tel:031-3095266" class="btn btn-dark">
                            <i class="fas fa-phone me-2"></i>
                            Hubungi Kami
                        </a>
                        <a href="https://wa.me/6281223456110" target="_blank" class="btn btn-success">
                            <i class="fab fa-whatsapp me-2"></i>
                            Chat WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Back Button --}}
    <div class="mt-5">
        <a href="{{ route('public.layanan.index') }}" class="btn btn-outline-dark">
            <i class="fas fa-arrow-left me-2"></i>
            Kembali ke Daftar Layanan
        </a>
    </div>
</div>
@endsection

@push('styles')
<style>
.requirements,
.procedure {
    line-height: 1.8;
}

.info-item i {
    font-size: 1.25rem;
}

.btn-dark {
    background: #1a1a1a;
    border: none;
    transition: all 0.3s;
}

.btn-dark:hover {
    background: #dc3545;
}

.card {
    border-radius: 12px;
}
</style>
@endpush
