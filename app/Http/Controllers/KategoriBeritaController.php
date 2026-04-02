<?php

namespace App\Http\Controllers;

use App\Models\KategoriBerita;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KategoriBeritaController extends Controller
{
    /**
     * Display listing of categories
     */
    public function index()
    {
        $kategoris = KategoriBerita::withCount('beritas')
                                   ->orderBy('nama_kategori', 'asc')
                                   ->paginate(10);
        
        return view('admin.kategori-berita.index', compact('kategoris'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        return view('admin.kategori-berita.create');
    }

    /**
     * Store new category
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:kategori_berita,nama_kategori',
            'deskripsi' => 'nullable|string|max:500',
            'is_active' => 'boolean',
        ], [
            'nama_kategori.required' => 'Nama kategori harus diisi',
            'nama_kategori.unique' => 'Kategori ini sudah ada',
            'nama_kategori.max' => 'Nama kategori maksimal 100 karakter',
        ]);

        // Generate slug
        $validated['slug'] = Str::slug($validated['nama_kategori']);
        $validated['is_active'] = $request->has('is_active') ? true : false;

        KategoriBerita::create($validated);

        return redirect()->route('admin.kategori-berita.index')
                        ->with('success', 'Kategori berhasil ditambahkan');
    }

    /**
     * Show edit form
     */
    public function edit(string $id)
    {
        $kategori = KategoriBerita::findOrFail($id);
        return view('admin.kategori-berita.edit', compact('kategori'));
    }

    /**
     * Update category
     */
    public function update(Request $request, string $id)
    {
        $kategori = KategoriBerita::findOrFail($id);

        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:kategori_berita,nama_kategori,' . $id . ',id_kategori',
            'deskripsi' => 'nullable|string|max:500',
            'is_active' => 'boolean',
        ], [
            'nama_kategori.required' => 'Nama kategori harus diisi',
            'nama_kategori.unique' => 'Kategori ini sudah ada',
            'nama_kategori.max' => 'Nama kategori maksimal 100 karakter',
        ]);

        // Update slug
        $validated['slug'] = Str::slug($validated['nama_kategori']);
        $validated['is_active'] = $request->has('is_active') ? true : false;

        $kategori->update($validated);

        return redirect()->route('admin.kategori-berita.index')
                        ->with('success', 'Kategori berhasil diupdate');
    }

    /**
     * Delete category
     */
    public function destroy(string $id)
    {
        $kategori = KategoriBerita::withCount('beritas')->findOrFail($id);

        // Check if category has berita
        if ($kategori->beritas_count > 0) {
            return redirect()->route('admin.kategori-berita.index')
                           ->with('error', 'Kategori tidak dapat dihapus karena masih memiliki ' . $kategori->beritas_count . ' berita');
        }

        $kategori->delete();

        return redirect()->route('admin.kategori-berita.index')
                        ->with('success', 'Kategori berhasil dihapus');
    }

    /**
     * Toggle active status
     */
    public function toggleActive(string $id)
    {
        $kategori = KategoriBerita::findOrFail($id);
        $kategori->is_active = !$kategori->is_active;
        $kategori->save();

        $status = $kategori->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return redirect()->route('admin.kategori-berita.index')
                        ->with('success', "Kategori berhasil {$status}");
    }
}
