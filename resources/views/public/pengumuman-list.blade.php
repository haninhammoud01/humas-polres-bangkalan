@extends('layouts.app')
@section('title', 'Pengumuman - Polres Bangkalan')
@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold">Pengumuman</h1>
        <p class="text-muted">Informasi terbaru seputar kegiatan dan layanan Polres Bangkalan</p>
    </div>

    <div class="row">
        @forelse($pengumumans as $pengumuman)
        <div class="col-md-6 mb-4">
            <div class="card h-100 border-0 shadow-sm pengumuman-card">
                <div class="card-body p-4">
                    <div class="text-muted small mb-2">
                        <i class="fas fa-calendar-alt me-1"></i>
                        {{ \Carbon\Carbon::parse($pengumuman->tanggal_pengumuman)->format('d M Y') }}
                    </div>
                    <h5 class="fw-bold mb-3" style="color: #1a1a1a;">{{ $pengumuman->judul }}</h5>
                    <p class="text-secondary mb-4">{{ Str::limit(strip_tags($pengumuman->konten), 130) }}</p>
                    <a href="{{ route('public.pengumuman.show', $pengumuman->id_pengumuman) }}" class="btn btn-dark btn-sm rounded-pill px-4">
                        Lihat Selengkapnya
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <i class="fas fa-bullhorn fa-4x text-muted mb-3"></i>
            <h5 class="text-muted">Belum ada pengumuman saat ini.</h5>
        </div>
        @endforelse
    </div>
    
    <div class="d-flex justify-content-center mt-4">
        {{ $pengumumans->links() }}
    </div>
</div>
@endsection

@push('styles')
<style>
    .pengumuman-card { border-radius: 15px; border-top: 5px solid #1a1a1a; transition: 0.3s; }
    .pengumuman-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important; border-top-color: #dc3545; }
    .btn-dark:hover { background: #dc3545 !important; border-color: #dc3545 !important; }
</style>
@endpush
