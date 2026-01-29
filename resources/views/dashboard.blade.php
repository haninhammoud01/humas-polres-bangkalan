@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container mt-5">
    
    <!-- Judul Dashboard -->
    <h2 class="mb-4"><i class="fas fa-tachometer-alt me-2"></i>Dashboard Admin</h2>

    <!-- Statistik Ringkas -->
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card bg-primary text-white shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Total Berita</h5>
                            <h2 class="display-4 fw-bold">{{ $totalBerita }}</h2>
                            <small>Diterbitkan</small>
                        </div>
                        <i class="fas fa-newspaper fa-3x opacity-25"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-success text-white shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Total Pengumuman</h5>
                            <h2 class="display-4 fw-bold">{{ $totalPengumuman }}</h2>
                            <small>Aktif</small>
                        </div>
                        <i class="fas fa-bullhorn fa-3x opacity-25"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-info text-white shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Admin Online</h5>
                            <h2 class="display-4 fw-bold">1</h2>
                            <small>{{ auth()->user()->nama }}</small>
                        </div>
                        <i class="fas fa-user-shield fa-3x opacity-25"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Berita Terbaru (Ringkasan) -->
    <div class="card shadow-sm">
        <div class="card-header bg-light">
            <h6 class="mb-0">5 Berita Terbaru</h6>
        </div>
        <div class="card-body p-0">
            <table class="table table-sm table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentBeritas as $item)
                    <tr>
                        <td>{{ Str::limit($item->judul, 40) }}</td>
                        <td>{{ $item->kategori->nama_kategori }}</td>
                        <td>{{ optional($item->tanggal_publish)->format('d M Y') }}</td>
                        <td>
                            <span class="badge bg-{{ $item->status == 'Published' ? 'success' : 'secondary' }}">
                                {{ $item->status }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="text-center text-muted">Belum ada berita.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
