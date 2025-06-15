<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menu = Menu::all();
        return view('menu.index', compact('menu'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('menu.create', compact('categories'));
    }

    public function store(Request $request)
    {
        try {
            // Bersihkan harga dari karakter non angka
            $request->merge([
                'harga' => preg_replace('/[^0-9]/', '', $request->input('harga'))
            ]);

            // Validasi input
            $request->validate([
                'foto_menu' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'nama_menu' => 'required|string|max:255',
                'harga' => 'required|integer',
                'deskripsi' => 'required|string',
                'status' => 'required|string|max:255',
                'category_id' => 'required|integer',
            ]);

            // Proses upload file
            if ($request->hasFile('foto_menu')) {
                $file = $request->file('foto_menu');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('menu', $filename, 'public');
            } else {
                $path = null;
            }

            // Simpan data ke database
            $data = [
                'foto_menu' => $path,
                'nama_menu' => $request->input('nama_menu'),
                'harga' => $request->input('harga'),
                'deskripsi' => $request->input('deskripsi'),
                'status' => $request->input('status'),
                'category_id' => $request->input('category_id'),
            ];

            Menu::create($data);

            return redirect('/list-menu')->with('status', 'Data berhasil ditambah.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function edit($id)
    {
        // Ambil 1 data menu, bukan collection
        $menu = Menu::where('id', $id)->firstOrFail();
        $categories = Category::all(); // Pastikan categories dikirim ke view

        return view('menu.edit', compact('menu', 'categories'));
    }

  public function update(Request $request, $id)
{
    try {
        // Bersihkan harga dari karakter non angka
        $request->merge([
            'harga' => preg_replace('/[^0-9]/', '', $request->input('harga'))
        ]);

        // Validasi input
        $request->validate([
            'foto_menu' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // file optional saat update
            'nama_menu' => 'required|string|max:255',
            'harga' => 'required|integer',
            'deskripsi' => 'required|string',
            'status' => 'required|string|max:255',
            'category_id' => 'required|integer',
        ]);

        // Cari data yang akan diupdate
        $menu = Menu::findOrFail($id);

        // Proses upload file jika ada file baru
        if ($request->hasFile('foto_menu')) {
            $file = $request->file('foto_menu');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('menu', $filename, 'public');

            // Hapus file lama jika ada (opsional, biar storage gak numpuk)
            if ($menu->foto_menu && \Storage::disk('public')->exists($menu->foto_menu)) {
                \Storage::disk('public')->delete($menu->foto_menu);
            }
        } else {
            $path = $menu->foto_menu; // pakai path lama jika tidak ada file baru
        }

        // Update data ke database
        $menu->update([
            'foto_menu' => $path,
            'nama_menu' => $request->input('nama_menu'),
            'harga' => $request->input('harga'),
            'deskripsi' => $request->input('deskripsi'),
            'status' => $request->input('status'),
            'category_id' => $request->input('category_id'),
        ]);

        return redirect('/list-menu')->with('status', 'Data berhasil diupdate.');
    } catch (\Exception $e) {
        return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])
            ->withInput();
    }
}

    public function delete($id)
    {
        Menu::destroy($id);
        return back();
    }
}
