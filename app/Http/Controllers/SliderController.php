<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        return view('admin.slider.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.slider.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required',
            'link' => 'nullable|url',
            'status' => 'required',
            'gambar' => 'required|image|mimes:jpg,jpeg,png|max:2048', // Gambar harus landscape
        ]);

        // Upload Slider
        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $imageName = time() . '_' . $image->getClientOriginalName();
            // Simpan di folder public/sliders
            $image->move(public_path('sliders'), $imageName);
            $validated['gambar'] = $imageName;
        }

        Slider::create($validated);
        return redirect()->route('admin.slider.index')->with('success', 'Slider berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $slider = Slider::findOrFail($id);
        return view('admin.slider.edit', compact('slider'));
    }

    public function update(Request $request, $id)
    {
        $slider = Slider::findOrFail($id);
        $validated = $request->validate([
            'judul' => 'required',
            'link' => 'nullable|url',
            'status' => 'required',
            'gambar' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            // Hapus lama
            if ($slider->gambar) {
                unlink(public_path('sliders/' . $slider->gambar));
            }
            // Upload Baru
            $image = $request->file('gambar');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('sliders'), $imageName);
            $validated['gambar'] = $imageName;
        }

        $slider->update($validated);
        return redirect()->route('admin.slider.index')->with('success', 'Slider berhasil diupdate!');
    }

    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);
        if ($slider->gambar) {
            unlink(public_path('sliders/' . $slider->gambar));
        }
        $slider->delete();
        return redirect()->route('admin.slider.index')->with('delete', 'Slider dihapus.');
    }
}
