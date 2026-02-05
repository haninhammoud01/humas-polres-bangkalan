<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    public function index()
    {
        $layanans = Layanan::all();
        return view('admin.layanan.index', compact('layanans'));
    }

    public function create()
    {
        return view('admin.layanan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_layanan' => 'required',
            'deskripsi' => 'required',
            'persyaratan' => 'required',
            'prosedur' => 'required',
            'waktu_layanan' => 'required',
            'biaya' => 'required',
            'urutan' => 'required|integer',
        ]);

        Layanan::create($validated);

        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil ditambahkan!');
    }

    public function show(Layanan $layanan)
    {
        // Opsional
    }

    public function edit($id)
    {
        $layanan = Layanan::findOrFail($id);
        return view('admin.layanan.edit', compact('layanan'));
    }

    public function update(Request $request, $id)
    {
        $layanan = Layanan::findOrFail($id);

        $validated = $request->validate([
            'nama_layanan' => 'required',
            'deskripsi' => 'required',
            'persyaratan' => 'required',
            'prosedur' => 'required',
            'waktu_layanan' => 'required',
            'biaya' => 'required',
            'urutan' => 'required|integer',
        ]);

        $layanan->update($validated);

        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $layanan = Layanan::findOrFail($id);
        $layanan->delete();

        return redirect()->route('admin.layanan.index')->with('delete', 'Layanan dihapus.');
    }

    // --- ROUTE PUBLIK ---

    // Menampilkan List Semua Layanan
    public function publicList()
    {
        // Urutkan berdasarkan kolom 'urutan'
        $layanans = Layanan::orderBy('urutan', 'asc')->get();
        return view('public.layanan-list', compact('layanans'));
    }

    // Menampilkan Detail Satu Layanan
    public function showPublic($id)
    {
        $layanan = Layanan::findOrFail($id);
        return view('public.layanan-detail', compact('layanan'));
    }
}
