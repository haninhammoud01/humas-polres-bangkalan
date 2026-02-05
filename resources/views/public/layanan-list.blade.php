@extends('layouts.app')

@section('title', 'Layanan Polres')

@section('content')
<div class="container py-5">
    
    <div class="text-center mb-5">
        <h2 class="fw-bold text-primary">Layanan Polres Bangkalan</h2>
        <p class="text-muted">Daftar layanan kepolisian untuk masyarakat</p>
    </div>

    <div class="row g-4">
        @foreach($layanans as $l)
        <div class="col-md-4">
            <a href="{{ route('public.layanan.show', $l->id_layanan) }}" class="text-decoration-none">
                <div class="card h-100 border-0 shadow-sm hover-card">
                    <div class="card-body p-4 text-center">
                        @if($l->icon)
                            <div class="mb-3">
                                <i class="{{ $l->icon }} fa-3x text-primary"></i>
                            </div>
                        @else
                            <div class="mb-3">
                                <i class="fas fa-id-card fa-3x text-primary"></i>
                            </div>
                        @endif

                        <h5 class="fw-bold text-dark">{{ $l->nama_layanan }}</h5>
                        <p class="text-muted small mb-0 text-truncate" style="max-height: 40px; overflow: hidden;">
                            {{ $l->deskripsi }}
                        </p>
                        <span class="text-primary small fw-bold mt-2 d-inline-block">Lihat Detail <i class="fas fa-arrow-right"></i></span>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>

</div>
@endsection
