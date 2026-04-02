@extends('layouts.admin')

@section('title', 'Album Foto')

@section('content')
<div class="container-fluid px-4">
    
    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <p class="text-muted mb-0">Kelola album foto galeri Polres Bangkalan</p>
        </div>
        <a href="{{ route('admin.album.create') }}" class="btn btn-dark">
            <i class="fas fa-plus me-2"></i>Buat Album Baru
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

    {{-- Grid Albums --}}
    <div class="row g-4">
        @forelse($albums as $album)
        <div class="col-md-6 col-lg-4 col-xl-3">
            <div class="album-card">
                <div class="album-cover">
                    {{-- Perbaikan: Menggunakan id_album dan nama_album --}}
                    @if($album->photos && $album->photos->count() > 0)
                        <img src="{{ $album->photos->first()->file_path }}" 
                             alt="{{ $album->nama_album }}"
                             onerror="this.src='https://via.placeholder.com/400x300/1a1a1a/ffffff?text=No+Image'">
                        <div class="album-count">{{ $album->photos_count }} foto</div>
                    @else
                        <div class="album-empty">
                            <i class="fas fa-folder-open fa-3x text-muted"></i>
                            <p class="text-muted mt-2 mb-0">Belum ada foto</p>
                        </div>
                    @endif
                </div>

                <div class="album-info">
                    {{-- Perbaikan: nama_album --}}
                    <h5 class="album-title">{{ $album->nama_album }}</h5>
                    <p class="album-desc">{{ Str::limit($album->deskripsi ?? 'Tidak ada deskripsi', 60) }}</p>
                    
                    <div class="album-meta">
                        <small class="text-muted">
                            <i class="far fa-calendar me-1"></i>
                            {{-- Perbaikan: Pengecekan Carbon --}}
                            @if($album->tanggal_dibuat)
                                {{ is_string($album->tanggal_dibuat) ? \Carbon\Carbon::parse($album->tanggal_dibuat)->format('d M Y') : $album->tanggal_dibuat->format('d M Y') }}
                            @else
                                {{ $album->created_at->format('d M Y') }}
                            @endif
                        </small>
                    </div>

                    {{-- Status Badge --}}
                    <div class="album-status mt-2">
                        @if($album->is_active ?? true)
                            <span class="badge bg-success">
                                <i class="fas fa-check me-1"></i>Aktif
                            </span>
                        @else
                            <span class="badge bg-secondary">
                                <i class="fas fa-eye-slash me-1"></i>Tidak Aktif
                            </span>
                        @endif
                    </div>
                </div>

                <div class="album-actions">
                    {{-- Perbaikan: Menggunakan id_album sebagai parameter --}}
                    <a href="{{ route('admin.album.edit', $album->id_album) }}" 
                       class="btn btn-sm btn-outline-primary"
                       title="Edit Album">
                        <i class="fas fa-edit"></i>
                    </a>
                    
                    @if($album->photos && $album->photos->count() > 0)
                    <a href="{{ route('admin.album.download', $album->id_album) }}" 
                       class="btn btn-sm btn-outline-success"
                       title="Download ZIP">
                        <i class="fas fa-download"></i>
                    </a>
                    @endif
                    
                    <form action="{{ route('admin.album.destroy', $album->id_album) }}" 
                          method="POST" 
                          class="d-inline"
                          onsubmit="return confirm('Yakin hapus album {{ $album->nama_album }}? Semua foto di dalamnya akan ikut terhapus!')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus Album">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="text-center py-5">
                <i class="fas fa-images fa-4x text-muted mb-3"></i>
                <h5 class="text-muted">Belum ada album foto</h5>
                <p class="text-muted">Mulai buat album untuk dokumentasi kegiatan Polres Bangkalan</p>
            </div>
        </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if($albums->hasPages())
    <div class="mt-4 d-flex justify-content-center">
        {{ $albums->links() }}
    </div>
    @endif

</div>
@endsection


@push('styles')
<style>
.album-card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 2px 12px rgba(0,0,0,0.08);
    transition: all 0.3s;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.album-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 24px rgba(0,0,0,0.15);
}

.album-cover {
    position: relative;
    height: 200px;
    background: linear-gradient(135deg, #f5f5f5 0%, #e0e0e0 100%);
    overflow: hidden;
}

.album-cover img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s;
}

.album-card:hover .album-cover img {
    transform: scale(1.05);
}

.album-empty {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100%;
}

.album-count {
    position: absolute;
    bottom: 10px;
    right: 10px;
    background: rgba(0,0,0,0.8);
    color: white;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 600;
}

.album-info {
    padding: 16px;
    flex: 1;
}

.album-title {
    font-size: 16px;
    font-weight: 600;
    color: #1a1a1a;
    margin-bottom: 8px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.album-desc {
    font-size: 13px;
    color: #666;
    margin-bottom: 12px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.album-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-bottom: 8px;
}

.album-status .badge {
    font-weight: 500;
    padding: 4px 10px;
}

.album-actions {
    padding: 12px 16px;
    border-top: 1px solid #eee;
    display: flex;
    gap: 8px;
    background: #fafafa;
}

.album-actions .btn {
    flex: 1;
}

.btn-dark {
    background: #1a1a1a;
    border: none;
    transition: all 0.3s;
}

.btn-dark:hover {
    background: #dc3545;
    transform: translateY(-2px);
}

.btn-outline-primary:hover {
    background: #0d6efd;
    color: white;
}

.btn-outline-success:hover {
    background: #198754;
    color: white;
}

.btn-outline-danger:hover {
    background: #dc3545;
    color: white;
}

/* Responsive */
@media (max-width: 768px) {
    .album-cover {
        height: 180px;
    }
    
    .album-actions .btn {
        padding: 6px 10px;
        font-size: 12px;
    }
}

/* Pagination */
.pagination {
    margin-bottom: 0;
}

.page-link {
    color: #1a1a1a;
    border-color: #dee2e6;
}

.page-link:hover {
    color: #dc3545;
    background-color: #f8f9fa;
    border-color: #dee2e6;
}

.page-item.active .page-link {
    background-color: #1a1a1a;
    border-color: #1a1a1a;
}
</style>
@endpush