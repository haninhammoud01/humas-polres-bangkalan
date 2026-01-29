<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    // 1. READ : Tampilkan List Pengumuman
    public function index()
    {
        // Gunakan scope 'terbaru' dari Model kamu
        $pengumuman = Pengumuman::terbaru()->get();
        return view('admin.pengumuman.index', compact('pengumuman'));
    }

    // 2. CREATE : Tampilkan Form Tambah
    public function create()
    {
        return view('admin.pengumuman.create');
    }

    // 3. STORE : Simpan Data Baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|max:255',
            'isi_pengumuman' => 'required',
            'prioritas' => 'required',
            'status' => 'required',
        ]);

        // Isi ID Pembuat dan Tanggal Otomatis
        $validated['id_pembuat'] = auth()->id();
        $validated['tanggal'] = now(); 

        Pengumuman::create($validated);

        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil diterbitkan!');
    }

    // 4. SHOW : Detail Satu Pengumuman (Opsional)
    public function show(Pengumuman $pengumuman)
    {
        return view('admin.pengumuman.show', compact('pengumuman'));
    }

    // 5. EDIT : Tampilkan Form Edit
    public function edit($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        return view('admin.pengumuman.edit', compact('pengumuman'));
    }

    // 6. UPDATE : Update Data
    public function update(Request $request, $id)
    {
        $pengumuman = Pengumuman::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|max:255',
            'isi_pengumuman' => 'required',
            'prioritas' => 'required',
            'status' => 'required',
        ]);

        $pengumuman->update($validated);

        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil diperbarui!');
    }

    // 7. DESTROY : Hapus Data
    public function destroy($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        $pengumuman->delete();

        return redirect()->route('admin.pengumuman.index')->with('delete', 'Pengumuman berhasil dihapus.');
    }
}
