@extends('layouts.admin')

@section('title', 'Kategori Berita')

@section('content')
<div class="container-fluid px-4">
    
    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <p class="text-muted mb-0">Kelola kategori untuk mengorganisir berita</p>
        </div>
        <a href="{{ route('admin.kategori-berita.create') }}" class="btn btn-dark">
            <i class="fas fa-plus me-2"></i>Tambah Kategori
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

    {{-- Table --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="px-4 py-3" width="5%">No</th>
                            <th class="py-3" width="25%">Nama Kategori</th>
                            <th class="py-3" width="30%">Deskripsi</th>
                            <th class="py-3 text-center" width="12%">Jumlah Berita</th>
                            <th class="py-3 text-center" width="10%">Status</th>
                            <th class="py-3 text-center" width="18%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kategoris as $index => $kategori)
                        <tr>
                            <td class="px-4">{{ $kategoris->firstItem() + $index }}</td>
                            <td>
                                <div class="fw-bold" style="color: #1a1a1a;">{{ $kategori->nama_kategori }}</div>
                                <small class="text-muted">{{ $kategori->slug }}</small>
                            </td>
                            <td>
                                <small class="text-muted">
                                    {{ $kategori->deskripsi ? Str::limit($kategori->deskripsi, 100) : '-' }}
                                </small>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-primary">{{ $kategori->beritas_count }}</span>
                            </td>
                            <td class="text-center">
                                @if($kategori->is_active)
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-secondary">Nonaktif</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    {{-- Toggle Status --}}
                                    <form action="{{ route('admin.kategori-berita.toggle-active', $kategori->id_kategori) }}" 
                                          method="POST" 
                                          class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" 
                                                class="btn btn-sm btn-outline-{{ $kategori->is_active ? 'warning' : 'success' }}" 
                                                title="{{ $kategori->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                                            <i class="fas fa-{{ $kategori->is_active ? 'eye-slash' : 'eye' }}"></i>
                                        </button>
                                    </form>

                                    {{-- Edit --}}
                                    <a href="{{ route('admin.kategori-berita.edit', $kategori->id_kategori) }}" 
                                       class="btn btn-sm btn-outline-primary"
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    {{-- Delete --}}
                                    <form action="{{ route('admin.kategori-berita.destroy', $kategori->id_kategori) }}" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('Yakin hapus kategori {{ $kategori->nama_kategori }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm btn-outline-danger"
                                                title="Hapus"
                                                {{ $kategori->beritas_count > 0 ? 'disabled' : '' }}>
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                <p class="text-muted mb-0">Belum ada kategori</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($kategoris->hasPages())
            <div class="p-3 border-top">
                {{ $kategoris->links() }}
            </div>
            @endif
        </div>
    </div>

</div>
@endsection

@push('styles')
<style>
.btn-dark {
    background: #1a1a1a;
    border: none;
    transition: all 0.3s;
}

.btn-dark:hover {
    background: #dc3545;
    transform: translateY(-2px);
}

.table thead th {
    font-weight: 600;
    color: #1a1a1a;
    border-bottom: 2px solid #dee2e6;
}

.table tbody tr:hover {
    background-color: #f8f9fa;
}

.btn-group .btn {
    border-radius: 0;
}

.btn-group .btn:first-child {
    border-radius: 6px 0 0 6px;
}

.btn-group .btn:last-child {
    border-radius: 0 6px 6px 0;
}

.card {
    border-radius: 12px;
}
</style>
@endpush
