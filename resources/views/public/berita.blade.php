@extends('layouts.app')

@section('title', $berita->judul)

@section('content')
<div class="container mt-5 mb-5">
    <div class="row">
        
        <!-- Kolom Utama (Konten Berita) -->
        <div class="col-lg-8">
            <article>
                <!-- Judul -->
                <h1 class="display-5 fw-bold mb-3">{{ $berita->judul }}</h1>
                
                <!-- Meta Info (Kategori, Tanggal, Penulis) -->
                <div class="d-flex align-items-center text-muted mb-4 border-bottom pb-3">
                    <span class="badge bg-primary me-2">{{ $berita->kategori->nama_kategori }}</span>
                    <span class="me-3"><i class="far fa-calendar-alt"></i> {{ optional($berita->tanggal_publish)->format('d F Y') }}</span>
                    <span><i class="far fa-user"></i> {{ $berita->penulis->nama ?? 'Admin' }}</span>
                </div>

                <!-- Gambar Utama -->
                @if($berita->gambar_utama)
                    <img src="{{ asset('berita/' . $berita->gambar_utama) }}" class="img-fluid rounded shadow-sm w-100 mb-4" alt="{{ $berita->judul }}">
                @endif

                <!-- Isi Berita -->
                <div class="blog-post-content mb-5" style="line-height: 1.8; font-size: 1.1rem;">
                    <!-- Parse teks biasa. Nanti kalau pakai editor rich text (ckeditor/summernote), ganti dengan {!! $berita->konten !!} -->
                    <p>{!! $berita->konten !!}</p>
                </div>
            </article>

            <!-- Tombol Kembali -->
            <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Kembali ke Beranda
            </a>
        </div>

        <!-- Kolom Kanan (Sidebar / Berita Terbaru) -->
        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <h6 class="mb-0 fw-bold"><i class="fas fa-fire"></i> Berita Terbaru</h6>
                </div>
                <div class="list-group list-group-flush">
                    @forelse($beritaTerbaru as $item)
                    <a href="{{ route('public.berita.show', $item->slug) }}" class="list-group-item list-group-item-action d-flex gap-3 py-3 align-items-center">
                        <!-- Thumbnail Kecil -->
                        @if($item->gambar_utama)
                            <img src="{{ asset('berita/' . $item->gambar_utama) }}" alt="thumb" width="60" height="60" class="rounded object-fit-cover">
                        @else
                            <img src="https://via.placeholder.com/60" class="rounded">
                        @endif
                        
                        <div class="d-flex gap-2 w-100 justify-content-between">
                            <div>
                                <h6 class="mb-0 text-dark text-truncate" style="max-width: 200px;">{{ $item->judul }}</h6>
                                <small class="text-muted">{{ optional($item->tanggal_publish)->format('d M') }}</small>
                            </div>
                        </div>
                    </a>
                    @empty
                    <div class="list-group-item text-center text-muted">Belum ada berita lain.</div>
                    @endforelse
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
