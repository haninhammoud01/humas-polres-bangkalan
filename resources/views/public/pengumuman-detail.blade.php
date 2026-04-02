@extends('layouts.app')
@section('title', $pengumuman->judul)
@section('content')
<div class="container py-5">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('public.pengumuman.index') }}">Pengumuman</a></li>
            <li class="breadcrumb-item active">{{ Str::limit($pengumuman->judul, 30) }}</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-5">
                    @if($pengumuman->prioritas == 'High')
                    <div class="alert alert-danger mb-4"><i class="fas fa-exclamation-triangle me-2"></i><strong>PENGUMUMAN PENTING</strong></div>
                    @endif
                    <h1 class="fw-bold mb-3">{{ $pengumuman->judul }}</h1>
                    <p class="text-muted mb-4"><i class="fas fa-calendar me-2"></i>{{ \Carbon\Carbon::parse($pengumuman->tanggal_pengumuman)->format('d F Y') }}</p>
                    
                    @if($pengumuman->media_url)
                    <div class="media-container mb-4">
                        @if(Str::contains($pengumuman->media_type, 'image'))
                            <img src="{{ $pengumuman->media_url }}" class="img-fluid rounded shadow" alt="Media">
                        @elseif(Str::contains($pengumuman->media_type, 'video'))
                            <video controls class="w-100 rounded shadow"><source src="{{ $pengumuman->media_url }}"></video>
                        @elseif(Str::contains($pengumuman->media_type, 'pdf'))
                            <div class="card bg-light p-4 text-center">
                                <i class="fas fa-file-pdf fa-3x text-danger mb-3"></i>
                                <a href="{{ $pengumuman->media_url }}" target="_blank" class="btn btn-danger">Download PDF <i class="fas fa-download ms-2"></i></a>
                            </div>
                        @endif
                    </div>
                    @endif
                    
                    <div class="content">{!! nl2br(e($pengumuman->konten)) !!}</div>
                    
                    <hr class="my-4">
                    <a href="{{ route('public.pengumuman.index') }}" class="btn btn-dark"><i class="fas fa-arrow-left me-2"></i>Kembali ke Pengumuman</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('styles')<style>.card{border-radius:12px}.btn-dark{background:#1a1a1a;border:none;padding:12px 40px;border-radius:8px;transition:all .3s}.btn-dark:hover{background:#dc3545;transform:translateY(-2px)}.breadcrumb{background:transparent;padding:0}.breadcrumb-item a{color:#1a1a1a;text-decoration:none}.breadcrumb-item a:hover{color:#dc3545}</style>@endpush
