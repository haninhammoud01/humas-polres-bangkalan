<?php

namespace App\Http\Controllers;

use App\Models\MenuNavigasi;
use Illuminate\Http\Request;

class MenuNavigasiController extends Controller
{
    /**
     * Display listing
     */
    public function index()
    {
        $menus = MenuNavigasi::ordered()->get();
        return view('admin.menu.index', compact('menus'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        return view('admin.menu.create');
    }

    /**
     * Store new menu
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_menu' => 'required|string|max:100',
            'url' => 'required|string|max:255',
            'icon' => 'nullable|string|max:50',
            'urutan' => 'required|integer|min:0',
            'target' => 'required|in:_self,_blank',
        ], [
            'nama_menu.required' => 'Nama menu harus diisi',
            'url.required' => 'URL harus diisi',
            'urutan.required' => 'Urutan harus diisi',
        ]);

        $validated['is_active'] = $request->has('is_active');

        MenuNavigasi::create($validated);

        return redirect()->route('admin.menu.index')
                        ->with('success', 'Menu berhasil ditambahkan');
    }

    /**
     * Show edit form
     */
    public function edit(string $id)
    {
        $menu = MenuNavigasi::findOrFail($id);
        return view('admin.menu.edit', compact('menu'));
    }

    /**
     * Update menu
     */
    public function update(Request $request, string $id)
    {
        $menu = MenuNavigasi::findOrFail($id);

        $validated = $request->validate([
            'nama_menu' => 'required|string|max:100',
            'url' => 'required|string|max:255',
            'icon' => 'nullable|string|max:50',
            'urutan' => 'required|integer|min:0',
            'target' => 'required|in:_self,_blank',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $menu->update($validated);

        return redirect()->route('admin.menu.index')
                        ->with('success', 'Menu berhasil diupdate');
    }

    /**
     * Delete menu
     */
    public function destroy(string $id)
    {
        $menu = MenuNavigasi::findOrFail($id);
        $menu->delete();

        return redirect()->route('admin.menu.index')
                        ->with('success', 'Menu berhasil dihapus');
    }

    /**
     * Toggle active status
     */
    public function toggleActive(string $id)
    {
        $menu = MenuNavigasi::findOrFail($id);
        $menu->is_active = !$menu->is_active;
        $menu->save();

        $status = $menu->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return redirect()->route('admin.menu.index')
                        ->with('success', "Menu berhasil {$status}");
    }

    /**
     * Reorder menu
     */
    public function reorder(Request $request)
    {
        $order = $request->input('order', []);

        foreach ($order as $index => $id) {
            MenuNavigasi::where('id_menu', $id)->update(['urutan' => $index + 1]);
        }

        return response()->json(['success' => true, 'message' => 'Urutan menu berhasil diupdate']);
    }
}
