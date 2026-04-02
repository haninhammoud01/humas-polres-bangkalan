@extends('layouts.admin')

@section('title', 'Kelola Layanan')

@section('content')
<div class="container-fluid px-4">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ route('admin.layanan.create') }}" class="btn btn-dark">
            <i class="fas fa-plus me-2"></i>Tambah Layanan
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">No</th>
                            <th width="5%">Icon</th>
                            <th width="25%">Nama Layanan</th>
                            <th width="15%">Slug</th>
                            <th width="10%">Urutan</th>
                            <th width="10%">Status</th>
                            <th width="15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($layanans as $index => $layanan)
                        <tr>
                            <td>{{ $layanans->firstItem() + $index }}</td>
                            <td>
                                @if($layanan->icon)
                                    <i class="fas {{ $layanan->icon }} fa-2x text-primary"></i>
                                @endif
                            </td>
                            <td>
                                <strong>{{ $layanan->nama_layanan }}</strong>
                                <br><small class="text-muted">{{ Str::limit($layanan->deskripsi, 50) }}</small>
                            </td>
                            <td><code>{{ $layanan->slug }}</code></td>
                            <td><span class="badge bg-secondary">{{ $layanan->urutan }}</span></td>
                            <td>
                                @if($layanan->is_active)
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-secondary">Nonaktif</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.layanan.edit', $layanan->id_layanan) }}" 
                                       class="btn btn-sm btn-dark">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('public.layanan.show', $layanan->slug) }}" 
                                       class="btn btn-sm btn-outline-dark" 
                                       target="_blank">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('admin.layanan.destroy', $layanan->id_layanan) }}" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('Yakin hapus layanan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                <p class="text-muted">Belum ada layanan</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-3">
                {{ $layanans->links() }}
            </div>
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
.btn-outline-dark:hover {
    background: #1a1a1a !important;
    border-color: #1a1a1a !important;
}
.card {
    border-radius: 12px;
}
</style>
@endpush
