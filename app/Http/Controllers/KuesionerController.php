<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Kuesioner;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

class KuesionerController extends Controller
{

    public function index()
    {
        $forms = Kuesioner::with('kategori')->orderBy('created_at', 'desc')->get();

        return view('form', compact('forms'));
    }



    public function create()
    {
        $categories = Kategori::orderBy('nama')->get(['id_kategori','nama']);
        return view('tambah-form', compact('categories'));
    }


    public function store(Request $request)
    {
        // VALIDASI
        $validated = $request->validate([
            'nama'            => ['required','string','max:255'],
            'id_kategori'     => ['required', Rule::exists('kategori','id_kategori')],
            'deskripsi'       => ['nullable','string'],
            'tanggal_mulai'   => ['nullable','date'],
            'tanggal_selesai' => ['nullable','date','after_or_equal:tanggal_mulai'],
            'sampul'          => ['nullable','image','max:5120'], 
        ], [
            'nama.required'        => 'Judul form wajib diisi.',
            'id_kategori.required' => 'Kategori wajib dipilih.',
            'id_kategori.exists'   => 'Kategori tidak valid.',
            'tanggal_selesai.after_or_equal' => 'Tanggal berakhir harus >= tanggal mulai.',
            'sampul.image'         => 'File sampul harus gambar (png/jpg/jpeg/gif).',
        ]);

        $sampulPath = null;
        if ($request->hasFile('sampul')) {
            // simpan ke storage/app/public/kuesioner
            $sampulPath = $request->file('sampul')->store('kuesioner', 'public');
        }


        $adminId   = auth('admin')->id() ?? auth()->id();
        $createdBy = auth('admin')->user()->nama
            ?? (auth()->user()->name ?? null);

        // SIMPAN
        $kuesioner = Kuesioner::create([
            'id_admin'        => $adminId,              
            'id_kategori'     => $validated['id_kategori'],
            'nama'            => $validated['nama'],
            'deskripsi'       => $validated['deskripsi'] ?? null,
            'sampul'          => $sampulPath, 
            'tanggal_mulai'   => $validated['tanggal_mulai'] ?? null,
            'tanggal_selesai' => $validated['tanggal_selesai'] ?? null,
            'created_by'      => $createdBy,
        ]);

        return redirect()
            ->route('forms.show', $kuesioner->id_kuesioner)
            ->with('success', 'Form berhasil dibuat.');
    }

    public function show($id)
    {
        $form = Kuesioner::with('kategori')->findOrFail($id);

        // siapkan url sampul (atau null)
        $coverUrl = $form->sampul ? Storage::url($form->sampul) : null;

        return view('detail-form', [
            'form'     => $form,
            'coverUrl' => $coverUrl,
        ]);
    }
}
