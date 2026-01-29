@extends('layouts.app')
@section('title', 'Kelola Pengumuman')
@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between mb-4">
        <h3>Pengumuman</h3>
        <a href="{{ route('admin.pengumuman.create') }}" class="btn btn-primary">Buat Pengumuman</a>
    </div>
    <table class="table">
        <thead>
            <tr><th>Judul</th><th>Prioritas</th><th>Status</th><th>Tanggal</th><th>Aksi</th></tr>
        </thead>
        <tbody>
            @foreach($pengumuman as $p)
            <tr>
                <td>{{ $p->judul }}</td>
                <td>
                    @if($p->prioritas == 'Tinggi')
                        <span class="badge bg-danger">{{ $p->prioritas }}</span>
                    @elseif($p->prioritas == 'Sedang')
                        <span class="badge bg-warning text-dark">{{ $p->prioritas }}</span>
                    @else
                        <span class="badge bg-success">{{ $p->prioritas }}</span>
                    @endif
                </td>
                <td><span class="badge bg-success">{{ $p->status }}</span></td>
                <td>{{ $p->tanggal->format('d M Y') }}</td>
                <td>
                    <a href="{{ route('admin.pengumuman.edit', $p->id_pengumuman) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.pengumuman.destroy', $p->id_pengumuman) }}" method="POST" style="display:inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
