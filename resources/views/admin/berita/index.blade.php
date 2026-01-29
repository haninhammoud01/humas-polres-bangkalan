@extends('layouts.app')

@section('title', 'Kelola Berita')

@section('content')
<div class="container mt-5">
    
    <!-- 1. Notifikasi Sukses (Alert) -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            <strong>Berhasil!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('delete'))
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
            <i class="fas fa-trash-alt me-2"></i>
            <strong>Dihapus!</strong> {{ session('delete') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- 2. Header & Tombol Tambah -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">
            <i class="fas fa-newspaper me-2"></i>Daftar Berita
        </h2>
        <a href="{{ route('admin.berita.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus-circle"></i> Tambah Berita
        </a>
    </div>

    <!-- 3. Tabel Data -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th width="5%">No</th>
                            <th>Judul</th>
                            <th width="15%">Kategori</th>
                            <th width="15%">Penulis</th>
                            <th width="15%">Tanggal</th>
                            <th width="10%">Status</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($beritas as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>
                                <!-- Link ke halaman detail publik -->
                                <a href="{{ route('public.berita.show', $item->slug) }}" target="_blank" class="text-decoration-none text-dark fw-bold">
                                    {{ $item->judul }} 
                                    <i class="fas fa-external-link-alt small text-primary ms-1"></i>
                                </a>
                                @if($item->ringkasan)
                                <br><small class="text-muted text-truncate d-inline-block" style="max-width: 300px;">{{ Str::limit($item->ringkasan, 60) }}</small>
                                @endif
                            </td>
                            <td>{{ $item->kategori->nama_kategori ?? '-' }}</td>
                            <td>
                                <span class="badge bg-secondary bg-opacity-10 text-secondary border">
                                    {{ $item->penulis->name ?? 'Unknown' }}
                                </span>
                            </td>
                            <td>{{ optional($item->tanggal_publish)->format('d M Y') ?? '-' }}</td>
                            <td>
                                @if($item->status == 'Published')
                                    <span class="badge bg-success">Published</span>
                                @else
                                    <span class="badge bg-warning text-dark">Draft</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.berita.edit', $item) }}" class="btn btn-sm btn-outline-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    
                                    <form action="{{ route('admin.berita.destroy', $item) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin ingin menghapus berita ini?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="fas fa-folder-open fa-3x mb-3 text-secondary opacity-25"></i>
                                <p class="mb-0">Belum ada data berita.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-center">
            {{ $beritas->links() }}
        </div>
    </div>
</div>
@endsection
