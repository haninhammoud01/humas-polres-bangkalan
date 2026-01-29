@extends('layouts.app')

@section('title', 'Kelola Layanan')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between mb-4">
        <h3><i class="fas fa-concierge-bell me-2"></i>Layanan Publik</h3>
        <a href="{{ route('admin.layanan.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Layanan
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Layanan</th>
                        <th>Biaya</th>
                        <th>Waktu</th>
                        <th>Urutan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($layanans as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td class="fw-bold">{{ $item->nama_layanan }}</td>
                        <td>{{ $item->biaya }}</td>
                        <td>{{ $item->waktu_layanan }}</td>
                        <td>{{ $item->urutan }}</td>
                        <td>
                            <a href="{{ route('admin.layanan.edit', $item->id_layanan) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.layanan.destroy', $item->id_layanan) }}" method="POST" style="display:inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus layanan ini?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center py-4">Belum ada layanan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
