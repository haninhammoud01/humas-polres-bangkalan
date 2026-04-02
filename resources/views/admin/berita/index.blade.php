@extends('layouts.admin')

@section('title', 'Kelola Berita')

@section('content')
<div class="container-fluid px-4">
    
    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <p class="text-muted mb-0">Manage semua berita dan artikel</p>
        </div>
        <a href="{{ route('admin.berita.create') }}" class="btn btn-dark">
            <i class="fas fa-plus me-2"></i>Tambah Berita
        </a>
    </div>

    {{-- Alert Messages --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Filter & Search --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('admin.berita.index') }}" method="GET">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Cari Berita</label>
                        <input type="text" 
                               name="search" 
                               class="form-control" 
                               placeholder="Cari judul atau konten..."
                               value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Kategori</label>
                        <select name="kategori" class="form-select">
                            <option value="">Semua Kategori</option>
                            @foreach($kategoris ?? [] as $kat)
                                <option value="{{ $kat->id_kategori }}" 
                                        {{ request('kategori') == $kat->id_kategori ? 'selected' : '' }}>
                                    {{ $kat->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Status</label>
                        <select name="status" class="form-select">
                            <option value="">Semua Status</option>
                            <option value="Published" {{ request('status') == 'Published' ? 'selected' : '' }}>
                                Published
                            </option>
                            <option value="Draft" {{ request('status') == 'Draft' ? 'selected' : '' }}>
                                Draft
                            </option>
                        </select>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-dark w-100">
                            <i class="fas fa-search me-2"></i>Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Berita List --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            @if($beritas->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4" width="150">Gambar</th>
                            <th>Judul</th>
                            <th width="150">Kategori</th>
                            <th width="120">Penulis</th>
                            <th width="120">Tanggal</th>
                            <th width="100">Status</th>
                            <th width="180" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($beritas as $berita)
                        <tr>
                            <td class="ps-4 align-middle">
                                @if($berita->gambar_utama)
                                <img src="{{ $berita->gambar_utama }}" 
                                     alt="{{ $berita->judul }}" 
                                     class="img-thumbnail"
                                     style="max-height: 60px; max-width: 100px; object-fit: cover;">
                                @else
                                <div class="bg-light d-flex align-items-center justify-content-center" 
                                     style="width: 100px; height: 60px;">
                                    <i class="fas fa-image text-muted"></i>
                                </div>
                                @endif
                            </td>
                            <td class="align-middle">
                                <strong>{{ Str::limit($berita->judul, 50) }}</strong>
                                <br>
                                <small class="text-muted">
                                    {{ Str::limit(strip_tags($berita->ringkasan ?? $berita->konten), 80) }}
                                </small>
                            </td>
                            <td class="align-middle">
                                @if($berita->kategori)
                                    <span class="badge bg-secondary">
                                        {{ $berita->kategori->nama_kategori }}
                                    </span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="align-middle">
                                <small>{{ $berita->penulis->nama ?? $berita->penulis->name ?? '-' }}</small>
                            </td>
                            <td class="align-middle">
                                <small>{{ $berita->tanggal_publish ? $berita->tanggal_publish->format('d M Y') : '-' }}</small>
                            </td>
                            <td class="align-middle">
                                @if($berita->status == 'Published')
                                    <span class="badge bg-success">Published</span>
                                @else
                                    <span class="badge bg-warning text-dark">Draft</span>
                                @endif
                            </td>
                            <td class="align-middle text-center">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('berita.show', $berita->slug) }}" 
                                       class="btn btn-sm btn-outline-secondary"
                                       title="Lihat"
                                       target="_blank">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.berita.edit', $berita->id_berita) }}" 
                                       class="btn btn-sm btn-dark"
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.berita.destroy', $berita->id_berita) }}" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($beritas->hasPages())
            <div class="p-3">
                {{ $beritas->appends(request()->query())->links() }}
            </div>
            @endif

            @else
            {{-- Empty State --}}
            <div class="text-center py-5">
                <i class="fas fa-newspaper fa-4x text-muted mb-3"></i>
                <h5 class="text-muted">
                    @if(request('search') || request('kategori') || request('status'))
                        Tidak ada berita ditemukan
                    @else
                        Belum ada berita
                    @endif
                </h5>
                <p class="text-muted mb-4">
                    @if(request('search') || request('kategori') || request('status'))
                        Coba ubah filter pencarian
                    @else
                        Tambahkan berita pertama Anda
                    @endif
                </p>
                @if(!request('search') && !request('kategori') && !request('status'))
                <a href="{{ route('admin.berita.create') }}" class="btn btn-dark">
                    <i class="fas fa-plus me-2"></i>Tambah Berita
                </a>
                @else
                <a href="{{ route('admin.berita.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-times me-2"></i>Reset Filter
                </a>
                @endif
            </div>
            @endif
        </div>
    </div>

</div>
@endsection

@push('styles')
<style>
.btn-dark {
    background: #1a1a1a !important;
    border-color: #1a1a1a !important;
    transition: all 0.3s;
}

.btn-dark:hover {
    background: #dc3545 !important;
    border-color: #dc3545 !important;
    transform: translateY(-2px);
}

.card {
    border-radius: 12px;
}

.form-control, .form-select {
    border-radius: 8px;
    border: 1px solid #dee2e6;
}

.form-control:focus, .form-select:focus {
    border-color: #1a1a1a;
    box-shadow: 0 0 0 0.2rem rgba(26, 26, 26, 0.1);
}

.table thead th {
    font-weight: 600;
    color: #666;
    border-bottom: 2px solid #dee2e6;
    padding: 12px 8px;
}

.table tbody td {
    padding: 12px 8px;
    vertical-align: middle;
}

.btn-group .btn {
    padding: 6px 12px;
}

.badge {
    padding: 6px 10px;
    border-radius: 6px;
}
</style>
@endpush
