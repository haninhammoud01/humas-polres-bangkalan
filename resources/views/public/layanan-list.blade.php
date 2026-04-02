@extends('layouts.app')

@section('title', 'Layanan Polres Bangkalan')

@section('content')
<div class="container py-5">
    {{-- Header --}}
    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold mb-3">Layanan Kami</h1>
        <p class="lead text-muted">Berbagai layanan yang tersedia di Polres Bangkalan</p>
    </div>

    {{-- Layanan Grid --}}
    @if(isset($layanans) && $layanans->count() > 0)
    <div class="row g-4">
        @foreach($layanans as $layanan)
        <div class="col-md-6 col-lg-3">
            <a href="{{ route('public.layanan.show', $layanan->slug) }}" class="text-decoration-none">
                <div class="card layanan-card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="layanan-icon mb-3">
                            @php
                                $icon = match(strtolower($layanan->nama_layanan)) {
                                    'skck' => 'skck.png',
                                    'sim' => 'sim.jpg',
                                    'samsat' => 'samsat.png',
                                    'layanan 110', '110' => 'Layanan110.png',
                                    default => null
                                };
                            @endphp

                            @if($icon)
                                <img src="{{ asset('assets/icons/' . $icon) }}" 
                                    alt="{{ $layanan->nama_layanan }}"
                                    class="img-fluid"
                                    style="max-height: 80px; width: auto; object-fit: contain;">
                            @else
                                <i class="fas fa-concierge-bell fa-4x text-muted"></i>
                            @endif
                        </div>
                        <h5 class="card-title fw-bold mb-2">{{ $layanan->nama_layanan }}</h5>
                        @if($layanan->deskripsi_singkat)
                            <p class="card-text text-muted small">{{ Str::limit($layanan->deskripsi_singkat, 80) }}</p>
                        @endif
                        <div class="mt-3">
                            <span class="btn btn-sm btn-dark">
                                Lihat Detail
                                <i class="fas fa-arrow-right ms-1"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>

    {{-- Pagination --}}
    @if($layanans->hasPages())
    <div class="d-flex justify-content-center mt-5">
        {{ $layanans->links() }}
    </div>
    @endif
    @else
    {{-- Empty State --}}
    <div class="text-center py-5">
        <i class="fas fa-concierge-bell fa-4x text-muted mb-4"></i>
        <h4 class="text-muted">Belum Ada Layanan</h4>
        <p class="text-muted">Informasi layanan akan ditampilkan di sini</p>
    </div>
    @endif
</div>
@endsection

@push('styles')
<style>
.layanan-card {
    transition: all 0.3s ease;
    border-radius: 12px;
    overflow: hidden;
}

.layanan-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 24px rgba(0,0,0,0.15) !important;
}

.layanan-icon {
    height: 80px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 10px;
}

.layanan-icon img {
    max-width: 100%;
    max-height: 100%;
}

.btn-dark {
    background: #1a1a1a;
    border: none;
    transition: all 0.3s;
    border-radius: 8px;
    padding: 8px 20px;
}

.btn-dark:hover {
    background: #dc3545;
    transform: scale(1.05);
}

.card-title {
    color: #1a1a1a;
    min-height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Dark mode support */
body.dark-mode .layanan-card {
    background: #2d2d2d;
}

body.dark-mode .card-title {
    color: #fff;
}

body.dark-mode .layanan-card:hover {
    background: #3d3d3d;
}
</style>
@endpush
