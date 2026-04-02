<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengumumanController extends Controller
{
    // ========================================
    // ADMIN METHODS
    // ========================================

    /**
     * Admin: List all pengumuman
     */
    public function index()
    {
        $pengumumans = Pengumuman::with('pembuat')
            ->orderBy('tanggal_pengumuman', 'desc')
            ->paginate(10);

        return view('admin.pengumuman.index', compact('pengumumans'));
    }

    /**
     * Admin: Show create form
     */
    public function create()
    {
        return view('admin.pengumuman.create');
    }

    /**
     * Admin: Store new pengumuman
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi_pengumuman' => 'required|string',
            'tanggal_pengumuman' => 'required|date',
            'prioritas' => 'required|in:Low,Medium,High',
            'media' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4,mov,avi|max:20480', // 20MB
        ]);

        $data = [
            'judul' => $request->judul,
            'isi_pengumuman' => $request->isi_pengumuman,
            'tanggal_pengumuman' => $request->tanggal_pengumuman,
            'prioritas' => $request->prioritas,
            'id_pembuat' => Auth::id(),
            'is_active' => true,
        ];

        // Upload media (image or video)
        if ($request->hasFile('media')) {
            $path = $request->file('media')->store('pengumuman', 'public');
            $data['media'] = $path;
        }

        Pengumuman::create($data);

        return redirect()->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil ditambahkan!');
    }

    /**
     * Admin: Show edit form
     */
    public function edit($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        return view('admin.pengumuman.edit', compact('pengumuman'));
    }

    /**
     * Admin: Update pengumuman
     */
    public function update(Request $request, $id)
    {
        $pengumuman = Pengumuman::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'isi_pengumuman' => 'required|string',
            'tanggal_pengumuman' => 'required|date',
            'prioritas' => 'required|in:Low,Medium,High',
            'media' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4,mov,avi|max:20480',
        ]);

        $data = [
            'judul' => $request->judul,
            'isi_pengumuman' => $request->isi_pengumuman,
            'tanggal_pengumuman' => $request->tanggal_pengumuman,
            'prioritas' => $request->prioritas,
        ];

        // Upload new media
        if ($request->hasFile('media')) {
            // Delete old media if exists and not URL
            if ($pengumuman->media && !str_starts_with($pengumuman->media, 'http')) {
                Storage::disk('public')->delete($pengumuman->media);
            }

            $path = $request->file('media')->store('pengumuman', 'public');
            $data['media'] = $path;
        }

        // Toggle active status if requested
        if ($request->has('is_active')) {
            $data['is_active'] = $request->boolean('is_active');
        }

        $pengumuman->update($data);

        return redirect()->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil diupdate!');
    }

    /**
     * Admin: Delete pengumuman
     */
    public function destroy($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);

        // Delete media from storage if exists and not URL
        if ($pengumuman->media && !str_starts_with($pengumuman->media, 'http')) {
            Storage::disk('public')->delete($pengumuman->media);
        }

        $pengumuman->delete();

        return redirect()->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil dihapus!');
    }

    // ========================================
    // PUBLIC METHODS
    // ========================================

    /**
     * Public: List pengumuman
     */
    public function publicList()
    {
        $pengumumans = Pengumuman::active()
            ->orderBy('prioritas', 'desc') // High first
            ->orderBy('tanggal_pengumuman', 'desc')
            ->paginate(12);

        return view('public.pengumuman-list', compact('pengumumans'));
    }

    /**
     * Public: Show single pengumuman
     */
    public function showPublic($id)
    {
        $pengumuman = Pengumuman::active()->findOrFail($id);

        // Get related pengumuman (same prioritas)
        $relatedPengumumans = Pengumuman::active()
            ->where('prioritas', $pengumuman->prioritas)
            ->where('id_pengumuman', '!=', $pengumuman->id_pengumuman)
            ->orderBy('tanggal_pengumuman', 'desc')
            ->take(3)
            ->get();

        return view('public.pengumuman-detail', compact('pengumuman', 'relatedPengumumans'));
    }

    /**
     * Get media type (image or video)
     */
    public function getMediaType($media)
    {
        if (!$media) {
            return null;
        }

        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $videoExtensions = ['mp4', 'mov', 'avi', 'wmv', 'flv'];

        $extension = strtolower(pathinfo($media, PATHINFO_EXTENSION));

        if (in_array($extension, $imageExtensions)) {
            return 'image';
        }

        if (in_array($extension, $videoExtensions)) {
            return 'video';
        }

        return 'unknown';
    }
}
