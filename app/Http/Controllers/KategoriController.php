<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KategoriController extends Controller
{
    public function index()
    {
        $categories = Kategori::withCount('kuesioner')
        ->orderBy('nama')
        ->get();
        return view('Admin.Kategori.kategori', compact('categories'));
    }

    // FORM TAMBAH
    public function create()
    {
        return view('Admin.Kategori.tambah-kategori');
    }

    // SIMPAN
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255|unique:kategori,nama',
        ], [
            'nama.required' => 'Nama kategori wajib diisi.',
            'nama.unique'   => 'Nama kategori sudah ada.',
        ]);

        Kategori::create(['nama' => $validated['nama']]);

        return redirect()->route('kategori')->with('success', 'Kategori berhasil ditambahkan.');
    }

    // FORM EDIT
    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('Admin.Kategori.edit-kategori', compact('kategori'));
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);

        $validated = $request->validate([
            'nama' => [
                'required',
                'string',
                'max:255',
                Rule::unique('kategori', 'nama')->ignore($kategori->id_kategori, 'id_kategori'),
            ],
        ], [
            'nama.required' => 'Nama kategori wajib diisi.',
            'nama.unique'   => 'Nama kategori sudah ada.',
        ]);

        $kategori->update(['nama' => $validated['nama']]);

        return redirect()->route('kategori')->with('success', 'Kategori berhasil diperbarui.');
    }

    // HAPUS
    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return redirect()->route('kategori')->with('success', 'Kategori berhasil dihapus.');
    }
}
