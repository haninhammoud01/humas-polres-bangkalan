<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    /**
     * Display a listing of sliders
     */
    public function index()
    {
        $sliders = Slider::orderBy('urutan')->paginate(10);
        return view('admin.slider.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new slider
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created slider
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'file_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', // 5MB
            'link' => 'nullable|url',
            'urutan' => 'required|integer|min:0',
        ]);

        $data = [
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'link' => $request->link,
            'urutan' => $request->urutan,
            'is_active' => true,
        ];

        // Upload image
        if ($request->hasFile('file_path')) {
            $path = $request->file('file_path')->store('slider', 'public');
            $data['file_path'] = $path;
        }

        Slider::create($data);

        return redirect()->route('admin.slider.index')
            ->with('success', 'Slider berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified slider
     */
    public function edit($id)
    {
        $slider = Slider::findOrFail($id);
        return view('admin.slider.edit', compact('slider'));
    }

    /**
     * Update the specified slider
     */
    public function update(Request $request, $id)
    {
        $slider = Slider::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'file_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'delete_file' => 'nullable',
            'link' => 'nullable|url',
            'urutan' => 'required|integer|min:0',
        ]);

        $data = [
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'link' => $request->link,
            'urutan' => $request->urutan,
            'is_active' => $request->has('is_active'),
        ];

        // Handle delete checkbox
        if ($request->has('delete_file') && $request->delete_file == '1') {
            if ($slider->file_path && !str_starts_with($slider->file_path, 'http')) {
                Storage::disk('public')->delete($slider->file_path);
            }
            $data['file_path'] = null;
        }

        // Upload new image
        if ($request->hasFile('file_path')) {
            // Delete old image if exists and not URL
            if ($slider->file_path && !str_starts_with($slider->file_path, 'http')) {
                Storage::disk('public')->delete($slider->file_path);
            }

            $path = $request->file('file_path')->store('slider', 'public');
            $data['file_path'] = $path;
        }

        $slider->update($data);

        return redirect()->route('admin.slider.index')
            ->with('success', 'Slider berhasil diupdate!');
    }

    /**
     * Remove the specified slider
     */
    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);

        // Delete image from storage if exists and not URL
        if ($slider->file_path && !str_starts_with($slider->file_path, 'http')) {
            Storage::disk('public')->delete($slider->file_path);
        }

        $slider->delete();

        return redirect()->route('admin.slider.index')
            ->with('success', 'Slider berhasil dihapus!');
    }
}
