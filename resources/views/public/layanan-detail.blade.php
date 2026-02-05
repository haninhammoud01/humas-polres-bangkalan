@extends('layouts.app')

@section('title', $layanan->nama_layanan)

@section('content')
<div class="container py-5">
    
    <!-- Tombol Kembali -->
    <a href="{{ route('public.layanan.list') }}" class="btn btn-secondary mb-4">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>

    <div class="row">
        <!-- Kolom Kiri: Isi Layanan -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-5">
                    <h2 class="fw-bold text-primary mb-4">{{ $layanan->nama_layanan }}</h2>
                    
                    <h5 class="fw-bold mt-4 mb-3">Persyaratan</h5>
                    <div class="alert alert-light">
                        {!! nl2br($layanan->persyaratan) !!}
                    </div>

                    <h5 class="fw-bold mt-4 mb-3">Prosedur</h5>
                    <p>{!! nl2br($layanan->prosedur) !!}</p>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Info Ringkas -->
        <div class="col-lg-4">
            <div class="card bg-primary text-white shadow-sm sticky-top" style="top: 100px;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4"><i class="fas fa-info-circle"></i> Informasi Layanan</h5>
                    
                    <div class="mb-3">
                        <small class="text-white-50">Waktu Pelayanan</small>
                        <p class="mb-0 fw-bold">{{ $layanan->waktu_layanan }}</p>
                    </div>

                    <div class="mb-3">
                        <small class="text-white-50">Biaya</small>
                        <p class="mb-0 fw-bold">{{ $layanan->biaya }}</p>
                    </div>

                    <hr class="border-light my-4">

                    <div class="text-center">
                        <p class="small">Untuk informasi lebih lanjut, hubungi:</p>
                        <p class="mb-0"><strong>(031) 3095110</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
