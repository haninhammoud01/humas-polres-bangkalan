@extends('layouts.app')
@section('title', 'Kelola Album')
@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between mb-4">
        <h3>Album Kegiatan</h3>
        <a href="{{ route('admin.album.create') }}" class="btn btn-primary">Buat Album</a>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr><th>Nama Album</th><th>Jumlah Foto</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @foreach($albums as $alb)
                <tr>
                    <td>{{ $alb->nama_album }}</td>
                    <td><span class="badge bg-secondary">{{ $alb->fotos->count() }}</span></td> <!-- Mengambil count dari relasi -->
                    <td>
                        <a href="{{ route('admin.galeri-foto.index', $alb->id_album) }}" class="btn btn-warning btn-sm">Kelola Foto</a>
                        <a href="#" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('public.galeri.show', $alb->id_album) }}" class="btn btn-primary btn-sm" target="_blank"><i class="fas fa-external-link-alt"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection>
