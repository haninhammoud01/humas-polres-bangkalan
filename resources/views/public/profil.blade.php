@extends('layouts.app')

@section('title', 'Profil Polres Bangkalan')

@section('content')
<div class="container py-5">
    
    {{-- Header --}}
    <div class="text-center mb-5">
        @if($profil->logo)
        <img src="{{ $profil->logo ? asset('storage/'.$profil->logo) : '' }}" alt="Logo" style="max-height: 100px;" class="mb-3">
        @endif
        <h1 class="fw-bold mb-2">{{ $profil->nama_instansi }}</h1>
        <p class="text-muted">{{ $profil->alamat }}</p>
    </div>

    {{-- Visi Misi --}}
    @if($profil->visi || $profil->misi)
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-4">
            <div class="row">
                @if($profil->visi)
                <div class="col-md-6 mb-3 mb-md-0">
                    <h4 class="fw-bold mb-3 text-primary">
                        <i class="fas fa-eye me-2"></i>Visi
                    </h4>
                    <p class="text-muted">{{ $profil->visi }}</p>
                </div>
                @endif
                
                @if($profil->misi)
                <div class="col-md-6">
                    <h4 class="fw-bold mb-3 text-success">
                        <i class="fas fa-bullseye me-2"></i>Misi
                    </h4>
                    <div class="text-muted" style="white-space: pre-line;">{{ $profil->misi }}</div>
                </div>
                @endif
            </div>
        </div>
    </div>
    @endif

    {{-- Sejarah --}}
    @if($profil->sejarah)
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-4">
            <h4 class="fw-bold mb-3">
                <i class="fas fa-history me-2 text-warning"></i>Sejarah
            </h4>
            <p class="text-muted" style="white-space: pre-line;">{{ $profil->sejarah }}</p>
        </div>
    </div>
    @endif

    {{-- Struktur Organisasi --}}
    @if($profil->hasStrukturOrganisasi())
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-4">
            <h4 class="fw-bold mb-4">
                <i class="fas fa-sitemap me-2 text-info"></i>Struktur Organisasi
            </h4>
            
            @if($profil->struktur_organisasi_text)
            <div class="mb-4 text-muted" style="white-space: pre-line;">
                {{ $profil->struktur_organisasi_text }}
            </div>
            @endif
        </div>
    </div>
    @endif

    {{-- Kontak --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <h4 class="fw-bold mb-4">
                <i class="fas fa-phone me-2 text-danger"></i>Hubungi Kami
            </h4>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <i class="fas fa-map-marker-alt text-danger me-2"></i>
                    <strong>Alamat:</strong><br>
                    <span class="text-muted">{{ $profil->alamat }}</span>
                </div>
                @if($profil->telepon)
                <div class="col-md-4 mb-3">
                    <i class="fas fa-phone text-danger me-2"></i>
                    <strong>Telepon:</strong><br>
                    <span class="text-muted">{{ $profil->telepon }}</span>
                </div>
                @endif
                @if($profil->email)
                <div class="col-md-4 mb-3">
                    <i class="fas fa-envelope text-danger me-2"></i>
                    <strong>Email:</strong><br>
                    <span class="text-muted">{{ $profil->email }}</span>
                </div>
                @endif
            </div>
        </div>
    </div>

</div>
@endsection

