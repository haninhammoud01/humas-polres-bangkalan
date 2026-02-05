@extends('layouts.app')

@section('title', 'Semua Berita - Polres Bangkalan')

@section('content')
<div class="container py-5">
    
    <div class="text-center mb-5">
        <h2 class="fw-bold text-primary">Arsip Berita</h2>
        <p class="text-muted">Kumpulan informasi terkini seputar Polres Bangkalan</p>
    </div>

    <div class="row g-4">
        @forelse($beritas as $item)
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm hover-card">
                <div style="height: 200px; overflow: hidden;" class="card-img-top bg-light">
                    @if($item->gambar_utama)
                        <!-- PASTIKAN PATH INI SUDAH FOTO_BERITA -->
                        <img src="{{ asset('foto_berita/' . $item->gambar_utama) }}" class="w-100 h-100 object-fit-cover" alt="{{ $item->judul }}">
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
                            {{ Str::limit($item->judul, 50) }}
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
        <div class="col-12 text-center">
            <p>Belum ada berita.</p>
        </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-5">
        {{ $beritas->links() }}
    </div>

</div>
@endsection
