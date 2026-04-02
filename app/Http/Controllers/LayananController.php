<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LayananController extends Controller
{
    // ========================================
    // ADMIN METHODS
    // ========================================

    /**
     * Admin: List all layanan
     */
    public function index()
    {
        $layanans = Layanan::orderBy('urutan')->paginate(10);
        return view('admin.layanan.index', compact('layanans'));
    }

    /**
     * Admin: Show create form
     */
    public function create()
    {
        return view('admin.layanan.create');
    }

    /**
     * Admin: Store new layanan
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_layanan' => 'required|string|max:255',
            'deskripsi_singkat' => 'nullable|string|max:500',
            'deskripsi' => 'required|string',
            'persyaratan' => 'nullable|string',
            'prosedur' => 'nullable|string',
            'biaya' => 'nullable|string|max:100',
            'waktu_proses' => 'nullable|string|max:100',
            'lokasi_pelayanan' => 'nullable|string',
            'kontak' => 'nullable|string|max:100',
            'icon_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'urutan' => 'nullable|integer',
        ]);

        $data = [
            'nama_layanan' => $request->nama_layanan,
            'slug' => Str::slug($request->nama_layanan),
            'deskripsi_singkat' => $request->deskripsi_singkat,
            'deskripsi' => $request->deskripsi,
            'persyaratan' => $request->persyaratan,
            'prosedur' => $request->prosedur,
            'biaya' => $request->biaya,
            'waktu_proses' => $request->waktu_proses,
            'lokasi_pelayanan' => $request->lokasi_pelayanan,
            'kontak' => $request->kontak,
            'urutan' => $request->urutan ?? 0,
            'is_active' => true,
        ];

        // Upload icon
        if ($request->hasFile('icon_image')) {
            $path = $request->file('icon_image')->store('layanan/icons', 'public');
            $data['icon_image'] = $path;
        }

        Layanan::create($data);

        return redirect()->route('admin.layanan.index')
            ->with('success', 'Layanan berhasil ditambahkan!');
    }

    /**
     * Admin: Show edit form
     */
    public function edit($id)
    {
        $layanan = Layanan::findOrFail($id);
        return view('admin.layanan.edit', compact('layanan'));
    }

    /**
     * Admin: Update layanan
     */
    public function update(Request $request, $id)
    {
        $layanan = Layanan::findOrFail($id);

        $request->validate([
            'nama_layanan' => 'required|string|max:255',
            'deskripsi_singkat' => 'nullable|string|max:500',
            'deskripsi' => 'required|string',
            'persyaratan' => 'nullable|string',
            'prosedur' => 'nullable|string',
            'biaya' => 'nullable|string|max:100',
            'waktu_proses' => 'nullable|string|max:100',
            'lokasi_pelayanan' => 'nullable|string',
            'kontak' => 'nullable|string|max:100',
            'icon_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'delete_icon' => 'nullable',
            'urutan' => 'nullable|integer',
        ]);

        $data = [
            'nama_layanan' => $request->nama_layanan,
            'slug' => Str::slug($request->nama_layanan),
            'deskripsi_singkat' => $request->deskripsi_singkat,
            'deskripsi' => $request->deskripsi,
            'persyaratan' => $request->persyaratan,
            'prosedur' => $request->prosedur,
            'biaya' => $request->biaya,
            'waktu_proses' => $request->waktu_proses,
            'lokasi_pelayanan' => $request->lokasi_pelayanan,
            'kontak' => $request->kontak,
            'urutan' => $request->urutan ?? $layanan->urutan,
        ];

        // Handle icon deletion
        if ($request->has('delete_icon') && $request->delete_icon == '1') {
            if ($layanan->icon_image && !str_starts_with($layanan->icon_image, 'http') && !str_starts_with($layanan->icon_image, '/assets')) {
                Storage::disk('public')->delete($layanan->icon_image);
            }
            $data['icon_image'] = null;
        }

        // Upload new icon
        if ($request->hasFile('icon_image')) {
            // Delete old icon if exists (not external URL or assets)
            if ($layanan->icon_image && !str_starts_with($layanan->icon_image, 'http') && !str_starts_with($layanan->icon_image, '/assets')) {
                Storage::disk('public')->delete($layanan->icon_image);
            }

            $path = $request->file('icon_image')->store('layanan/icons', 'public');
            $data['icon_image'] = $path;
        }

        $layanan->update($data);

        return redirect()->route('admin.layanan.index')
            ->with('success', 'Layanan berhasil diupdate!');
    }

    /**
     * Admin: Delete layanan
     */
    public function destroy($id)
    {
        $layanan = Layanan::findOrFail($id);

        // Delete icon if exists (not external URL or assets)
        if ($layanan->icon_image && !str_starts_with($layanan->icon_image, 'http') && !str_starts_with($layanan->icon_image, '/assets')) {
            Storage::disk('public')->delete($layanan->icon_image);
        }

        $layanan->delete();

        return redirect()->route('admin.layanan.index')
            ->with('success', 'Layanan berhasil dihapus!');
    }

    // ========================================
    // PUBLIC METHODS
    // ========================================

    /**
     * Public: List layanan
     */
    public function publicList()
    {
        $layanans = Layanan::where('is_active', true)
            ->orderBy('urutan')
            ->paginate(12);

        return view('public.layanan-list', compact('layanans'));
    }

    /**
     * Public: Show single layanan
     */
    public function show($slug)
    {
        $layanan = Layanan::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        // Get related layanan
        $relatedLayanans = Layanan::where('is_active', true)
            ->where('id_layanan', '!=', $layanan->id_layanan)
            ->orderBy('urutan')
            ->take(3)
            ->get();

        return view('public.layanan-detail', compact('layanan', 'relatedLayanans'));
    }
}
