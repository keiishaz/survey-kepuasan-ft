<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Kuesioner;
use App\Models\Responden;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

class KuesionerController extends Controller
{

    public function index(Request $request)
    {
        $query = Kuesioner::with('kategori');

        // Search functionality
        if ($request->filled('search')) {
            $query->where('nama', 'LIKE', '%' . $request->search . '%');
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('id_kategori', $request->category);
        }

        // Filter by status
        if ($request->filled('status')) {
            if ($request->status === 'aktif') {
                $query->where('tanggal_mulai', '<=', now())
                      ->where(function($q) {
                          $q->whereNull('tanggal_selesai')
                            ->orWhere('tanggal_selesai', '>=', now());
                      });
            } elseif ($request->status === 'nonaktif') {
                $query->where(function($q) {
                    $q->where('tanggal_mulai', '>', now())
                      ->orWhere('tanggal_selesai', '<', now());
                });
            }
        }

        // Default ordering by creation date
        $query->orderBy('created_at', 'desc');

        $forms = $query->get();

        // Get categories for filter dropdown
        $categories = \App\Models\Kategori::orderBy('nama')->get();

        return view('Admin.Form.form', compact('forms', 'categories'));
    }



    public function create()
    {
        $categories = Kategori::orderBy('nama')->get(['id_kategori','nama']);
        return view('Admin.Form.tambah-form', compact('categories'));
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

        return view('Admin.Form.detail-form', [
            'form'     => $form,
            'coverUrl' => $coverUrl,
        ]);
    }

    public function editPertanyaan($id)
    {
        $form = Kuesioner::with('kategori')->findOrFail($id);

        // Get existing identitas configuration
        $identitas = $form->identitas()->first();

        // Default identitas if none exists
        if (!$identitas) {
            $identitas = [
                'atribut1' => 'Nama Lengkap',
                'atribut2' => 'Email',
                'atribut3' => 'Program Studi',
                'atribut4' => 'Angkatan',
                'atribut5' => 'Status',
                'wajib1' => false,
                'wajib2' => false,
                'wajib3' => false,
                'wajib4' => false,
                'wajib5' => false,
            ];
        } else {
            $identitas = [
                'atribut1' => $identitas->atribut1,
                'atribut2' => $identitas->atribut2,
                'atribut3' => $identitas->atribut3,
                'atribut4' => $identitas->atribut4,
                'atribut5' => $identitas->atribut5,
                'wajib1' => $identitas->wajib1,
                'wajib2' => $identitas->wajib2,
                'wajib3' => $identitas->wajib3,
                'wajib4' => $identitas->wajib4,
                'wajib5' => $identitas->wajib5,
            ];
        }

        // Get all questions
        $questions = $form->pertanyaan()->orderBy('urutan')->get();

        return view('Admin.Form.edit-pertanyaan', compact('form', 'identitas', 'questions'));
    }

    public function updatePertanyaan(Request $request, $id)
    {
        $form = Kuesioner::findOrFail($id);

        // Parse the identitas data
        $identitasData = json_decode($request->identitas_data, true);

        // Update or create identitas configuration
        $identitas = $form->identitas()->first();
        if ($identitas) {
            $identitas->update([
                'atribut1' => $identitasData['atribut1'] ?? null,
                'atribut2' => $identitasData['atribut2'] ?? null,
                'atribut3' => $identitasData['atribut3'] ?? null,
                'atribut4' => $identitasData['atribut4'] ?? null,
                'atribut5' => $identitasData['atribut5'] ?? null,
                'wajib1' => $identitasData['wajib1'] ?? false,
                'wajib2' => $identitasData['wajib2'] ?? false,
                'wajib3' => $identitasData['wajib3'] ?? false,
                'wajib4' => $identitasData['wajib4'] ?? false,
                'wajib5' => $identitasData['wajib5'] ?? false,
            ]);
        } else {
            $adminId = auth('admin')->id() ?? auth()->id();
            $form->identitas()->create([
                'id_admin' => $adminId,
                'id_kuesioner' => $form->id_kuesioner,
                'atribut1' => $identitasData['atribut1'] ?? null,
                'atribut2' => $identitasData['atribut2'] ?? null,
                'atribut3' => $identitasData['atribut3'] ?? null,
                'atribut4' => $identitasData['atribut4'] ?? null,
                'atribut5' => $identitasData['atribut5'] ?? null,
                'wajib1' => $identitasData['wajib1'] ?? false,
                'wajib2' => $identitasData['wajib2'] ?? false,
                'wajib3' => $identitasData['wajib3'] ?? false,
                'wajib4' => $identitasData['wajib4'] ?? false,
                'wajib5' => $identitasData['wajib5'] ?? false,
            ]);
        }

        // Parse the questions data
        $questionsData = json_decode($request->questions_data, true);

        // Process questions - first, remove all existing questions for this form
        $form->pertanyaan()->delete();

        // Then recreate questions from the data
        foreach ($questionsData as $questionData) {
            $form->pertanyaan()->create([
                'teks' => $questionData['text'],
                'status_aktif' => $questionData['required'],
            ]);
        }

        return redirect()->route('forms.show', $form->id_kuesioner)->with('success', 'Pertanyaan berhasil diperbarui.');
    }

    public function edit($id)
    {
        $form = Kuesioner::findOrFail($id);
        $categories = \App\Models\Kategori::orderBy('nama')->get(['id_kategori','nama']);

        return view('Admin.Form.edit-form', compact('form', 'categories'));
    }

    public function update(Request $request, $id)
    {
        // VALIDASI
        $validated = $request->validate([
            'nama'            => ['required','string','max:255'],
            'id_kategori'     => ['required', 'exists:kategori,id_kategori'],
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

        $form = Kuesioner::findOrFail($id);

        $sampulPath = $form->sampul; // Keep existing path if no new file uploaded
        if ($request->hasFile('sampul')) {
            // Delete old file if exists
            if ($form->sampul) {
                \Storage::delete($form->sampul);
            }
            // Save new file
            $sampulPath = $request->file('sampul')->store('kuesioner', 'public');
        } else if ($request->has('remove_sampul') && $request->remove_sampul == '1') {
            // If user requested to remove the image
            if ($form->sampul) {
                \Storage::delete($form->sampul);
            }
            $sampulPath = null;
        }

        // UPDATE
        $form->update([
            'id_kategori'     => $validated['id_kategori'],
            'nama'            => $validated['nama'],
            'deskripsi'       => $validated['deskripsi'] ?? null,
            'sampul'          => $sampulPath,
            'tanggal_mulai'   => $validated['tanggal_mulai'] ?? null,
            'tanggal_selesai' => $validated['tanggal_selesai'] ?? null,
        ]);

        return redirect()
            ->route('forms.show', $form->id_kuesioner)
            ->with('success', 'Form berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $form = Kuesioner::with(['respondens.jawaban', 'identitas', 'pertanyaan'])->findOrFail($id);

        // Delete related jawaban first (they depend on responden)
        foreach ($form->respondens as $responden) {
            $responden->jawaban()->delete(); // Delete related jawaban
            $responden->delete(); // Delete the responden
        }

        // Delete related identitas and pertanyaan
        $form->identitas()->delete();  // Delete related identitas configuration
        $form->pertanyaan()->delete(); // Delete related questions

        // Finally delete the form itself
        $form->delete();

        return redirect()->route('forms.index')->with('success', 'Form berhasil dihapus.');
    }

    public function lihatResponden($id)
    {
        $form = Kuesioner::with('kategori')->findOrFail($id);

        // Ambil data responden untuk form ini beserta jawaban dan pertanyaan
        $respondens = $form->respondens()->with(['jawaban.pertanyaan'])->get();

        // Hitung total responden
        $totalResponden = $respondens->count();

        // Ambil semua jawaban untuk keperluan statistik
        $jawabanSemua = $respondens->pluck('jawaban')->flatten();

        // Ambil data untuk grafik distribusi jawaban per pertanyaan
        $statistikPertanyaan = [];
        foreach($form->pertanyaan as $pertanyaan) {
            // Filter jawaban hanya untuk pertanyaan ini
            $jawabanPertanyaanIni = $jawabanSemua->where('id_pertanyaan', $pertanyaan->id_pertanyaan);

            // Hitung distribusi jawaban (1-5)
            $distribusi = [
                1 => $jawabanPertanyaanIni->where('jawaban', 1)->count(),
                2 => $jawabanPertanyaanIni->where('jawaban', 2)->count(),
                3 => $jawabanPertanyaanIni->where('jawaban', 3)->count(),
                4 => $jawabanPertanyaanIni->where('jawaban', 4)->count(),
                5 => $jawabanPertanyaanIni->where('jawaban', 5)->count(),
            ];

            $statistikPertanyaan[] = [
                'pertanyaan' => $pertanyaan->teks,
                'distribusi' => $distribusi,
                'id_pertanyaan' => $pertanyaan->id_pertanyaan
            ];
        }

        // Siapkan url sampul (atau null)
        $coverUrl = $form->sampul ? Storage::url($form->sampul) : null;

        return view('Admin.responden', [
            'form'     => $form,
            'coverUrl' => $coverUrl,
            'respondens' => $respondens,
            'totalResponden' => $totalResponden,
            'statistikPertanyaan' => $statistikPertanyaan
        ]);
    }

    public function cariSurvey()
    {
        // Ambil hanya survey yang aktif (status aktif)
        $surveys = \App\Models\Kuesioner::with('kategori')
                    ->where('tanggal_mulai', '<=', now())
                    ->where('tanggal_selesai', '>=', now())
                    ->orWhere(function ($query) {
                        $query->whereNull('tanggal_mulai')
                              ->whereNull('tanggal_selesai');
                    })
                    ->get();

        return view('cari-survey', compact('surveys'));
    }

    public function isiSurvey($id)
    {
        $survey = Kuesioner::with(['kategori', 'pertanyaan', 'identitas'])
                    ->where('id_kuesioner', $id)
                    ->where(function ($query) {
                        $query->where('tanggal_mulai', '<=', now())
                              ->where('tanggal_selesai', '>=', now());
                    })
                    ->orWhere(function ($query) {
                        $query->whereNull('tanggal_mulai')
                              ->whereNull('tanggal_selesai');
                    })
                    ->firstOrFail();

        return view('isi-survey', compact('survey'));
    }

    public function storeJawaban(Request $request, $id)
    {
        $survey = Kuesioner::with(['kategori', 'pertanyaan', 'identitas'])
                    ->where('id_kuesioner', $id)
                    ->where(function ($query) {
                        $query->where('tanggal_mulai', '<=', now())
                              ->where('tanggal_selesai', '>=', now());
                    })
                    ->orWhere(function ($query) {
                        $query->whereNull('tanggal_mulai')
                              ->whereNull('tanggal_selesai');
                    })
                    ->firstOrFail();

        // Validasi input identitas jika ada konfigurasi
        if ($survey->identitas) {
            $rules = [];

            if ($survey->identitas->wajib1) {
                $rules['identitas1'] = 'required|string|max:255';
            }

            if ($survey->identitas->wajib2) {
                $rules['identitas2'] = 'required|string|max:255';
            }

            if ($survey->identitas->wajib3) {
                $rules['identitas3'] = 'required|string|max:255';
            }

            if ($survey->identitas->wajib4) {
                $rules['identitas4'] = 'required|string|max:255';
            }

            if ($survey->identitas->wajib5) {
                $rules['identitas5'] = 'required|string|max:255';
            }

            $request->validate($rules);
        }

        // Simpan data responden termasuk jawaban identitas ke kolom yang sesuai
        $responden = $survey->respondens()->create([
            'id_kuesioner' => $survey->id_kuesioner,
            'identitas1' => $request->input('identitas1', null),
            'identitas2' => $request->input('identitas2', null),
            'identitas3' => $request->input('identitas3', null),
            'identitas4' => $request->input('identitas4', null),
            'identitas5' => $request->input('identitas5', null),
            // Jangan set waktu_submit dulu karena nanti akan diupdate setelah jawaban disimpan
        ]);

        // Save answer if available
        if ($request->has('jawaban')) {
            foreach ($request->jawaban as $id_pertanyaan => $isi_jawaban) {
                // Pastikan id_pertanyaan adalah angka (bukan 0 yang digunakan untuk identitas)
                if ($id_pertanyaan != 0) {
                    // Validasi bahwa jawaban adalah angka antara 1-5
                    if (is_numeric($isi_jawaban) && $isi_jawaban >= 1 && $isi_jawaban <= 5) {
                        $responden->jawaban()->create([
                            'id_pertanyaan' => $id_pertanyaan,
                            'jawaban' => $isi_jawaban,
                        ]);
                    }
                }
            }
        }

        // Update waktu submit setelah semua jawaban disimpan
        $responden->update([
            'waktu_submit' => now(),
        ]);

        // Redirect ke halaman selesai survey
        return redirect()->route('isi-survey.selesai', ['id' => $survey->id_kuesioner]);
    }

    public function selesai($id)
    {
        $survey = Kuesioner::findOrFail($id);

        return view('isi-survey-selesai', compact('survey'));
    }

    public function exportResponden($id)
    {
        $form = Kuesioner::with('kategori')->findOrFail($id);
        $respondens = $form->respondens()->with(['jawaban.pertanyaan'])->get();

        // Siapkan header CSV
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="responden_' . $form->nama . '_' . now()->format('Y-m-d_H-i-s') . '.csv"',
        ];

        // Buat response CSV
        $callback = function() use ($form, $respondens) {
            $file = fopen('php://output', 'w');

            // Header baris
            $row = ['ID Responden', 'Waktu Submit'];

            // Tambahkan header identitas
            if ($form->identitas) {
                if ($form->identitas->atribut1) $row[] = $form->identitas->atribut1;
                if ($form->identitas->atribut2) $row[] = $form->identitas->atribut2;
                if ($form->identitas->atribut3) $row[] = $form->identitas->atribut3;
                if ($form->identitas->atribut4) $row[] = $form->identitas->atribut4;
                if ($form->identitas->atribut5) $row[] = $form->identitas->atribut5;
            }

            // Tambahkan header pertanyaan
            foreach($form->pertanyaan as $pertanyaan) {
                $row[] = $pertanyaan->teks;
            }

            fputcsv($file, $row);

            // Baris data responden
            foreach($respondens as $responden) {
                $row = [
                    $responden->id_respon,
                    $responden->waktu_submit ? \Carbon\Carbon::parse($responden->waktu_submit)->format('Y-m-d H:i:s') : 'Belum selesai'
                ];

                // Tambahkan data identitas
                if ($form->identitas) {
                    if ($form->identitas->atribut1) $row[] = $responden->identitas1;
                    if ($form->identitas->atribut2) $row[] = $responden->identitas2;
                    if ($form->identitas->atribut3) $row[] = $responden->identitas3;
                    if ($form->identitas->atribut4) $row[] = $responden->identitas4;
                    if ($form->identitas->atribut5) $row[] = $responden->identitas5;
                }

                // Tambahkan jawaban untuk setiap pertanyaan
                foreach($form->pertanyaan as $pertanyaan) {
                    $jawaban = $responden->jawaban->firstWhere('id_pertanyaan', $pertanyaan->id_pertanyaan);
                    $row[] = $jawaban ? $jawaban->jawaban : '';
                }

                fputcsv($file, $row);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
