@extends('layouts.admin')

@section('title', 'Kelola Pengumuman')

@section('content')
<div class="container-fluid px-4">
    
    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <p class="text-muted mb-0">Manage pengumuman dan informasi penting</p>
        </div>
        <a href="{{ route('admin.pengumuman.create') }}" class="btn btn-dark">
            <i class="fas fa-plus me-2"></i>Tambah Pengumuman
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

    {{-- Pengumuman Table --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            @if($pengumumans->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4" width="60">No</th>
                            <th width="150">Media</th>
                            <th>Judul & Isi</th>
                            <th width="120">Tanggal</th>
                            <th width="100">Status</th>
                            <th width="180" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pengumumans as $index => $pengumuman)
                        <tr>
                            <td class="ps-4 align-middle">
                                <span class="text-muted">{{ $pengumumans->firstItem() + $index }}</span>
                            </td>
                            <td class="align-middle">
                                @if($pengumuman->media)
                                    <img src="{{ $pengumuman->media }}" 
                                         alt="Media" 
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
                                <strong>{{ Str::limit($pengumuman->judul, 50) }}</strong>
                                <br>
                                <small class="text-muted">
                                    {{ Str::limit(strip_tags($pengumuman->isi_pengumuman), 80) }}
                                </small>
                            </td>
                            <td class="align-middle">
                                <small>
                                    @if($pengumuman->tanggal_pengumuman)
                                        @if(is_string($pengumuman->tanggal_pengumuman))
                                            {{ \Carbon\Carbon::parse($pengumuman->tanggal_pengumuman)->format('d M Y') }}
                                        @else
                                            {{ $pengumuman->tanggal_pengumuman->format('d M Y') }}
                                        @endif
                                    @else
                                        -
                                    @endif
                                </small>
                            </td>
                            <td class="align-middle">
                                @if($pengumuman->prioritas == 'High')
                                    <span class="badge bg-danger">High</span>
                                @elseif($pengumuman->prioritas == 'Medium')
                                    <span class="badge bg-warning text-dark">Medium</span>
                                @else
                                    <span class="badge bg-secondary">Low</span>
                                @endif
                            </td>
                            <td class="align-middle">
                                @if($pengumuman->is_active)
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-secondary">Nonaktif</span>
                                @endif
                            </td>
                            <td class="align-middle text-center">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('public.pengumuman.show', $pengumuman->id_pengumuman) }}" 
                                       class="btn btn-sm btn-outline-secondary"
                                       title="Lihat"
                                       target="_blank">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.pengumuman.edit', $pengumuman->id_pengumuman) }}" 
                                       class="btn btn-sm btn-dark"
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.pengumuman.destroy', $pengumuman->id_pengumuman) }}" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus pengumuman ini?')">
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
            @if($pengumumans->hasPages())
            <div class="p-3">
                {{ $pengumumans->links() }}
            </div>
            @endif

            @else
            {{-- Empty State --}}
            <div class="text-center py-5">
                <i class="fas fa-bullhorn fa-4x text-muted mb-3"></i>
                <h5 class="text-muted">Belum ada pengumuman</h5>
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
