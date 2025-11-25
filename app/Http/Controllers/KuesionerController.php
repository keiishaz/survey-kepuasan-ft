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
        $query = Kuesioner::with('kategori')->withCount('respondens');

        // Search functionality
        if ($request->filled('search')) {
            $query->where('nama', 'LIKE', '%' . $request->search . '%');
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('id_kategori', $request->category);
        }

        // Filter by status - consider manual status override
        if ($request->filled('status')) {
            if ($request->status === 'aktif') {
                $query->where(function($q) {
                    // Forms with manual status set to active
                    $q->where('status_manual', true)
                      // OR forms with manual status not set (null) AND automatic logic says it's active
                      ->orWhere(function($subQuery) {
                          $subQuery->whereNull('status_manual')
                                   ->where(function($dateQuery) {
                                       $dateQuery->where(function($q2) {
                                           // Forms with no start and end date - always active
                                           $q2->whereNull('tanggal_mulai')
                                             ->whereNull('tanggal_selesai');
                                       })
                                       ->orWhere(function($q3) {
                                           // Forms with start date but no end date - active if start date has passed
                                           $q3->whereNotNull('tanggal_mulai')
                                             ->whereNull('tanggal_selesai')
                                             ->where('tanggal_mulai', '<=', now());
                                       })
                                       ->orWhere(function($q4) {
                                           // Forms with both start and end date - active if today is between them
                                           $q4->whereNotNull('tanggal_mulai')
                                             ->whereNotNull('tanggal_selesai')
                                             ->where('tanggal_mulai', '<=', now())
                                             ->where('tanggal_selesai', '>=', now());
                                       });
                                   });
                      });
                });
            } elseif ($request->status === 'nonaktif') {
                $query->where(function($q) {
                    // Forms with manual status set to non active
                    $q->where('status_manual', false)
                      // OR forms with manual status not set (null) AND automatic logic says it's non active
                      ->orWhere(function($subQuery) {
                          $subQuery->whereNull('status_manual')
                                   ->where(function($dateQuery) {
                                       $dateQuery->where(function($q2) {
                                           // Forms with start date that hasn't yet arrived
                                           $q2->whereNotNull('tanggal_mulai')
                                             ->where('tanggal_mulai', '>', now());
                                       })
                                       ->orWhere(function($q3) {
                                           // Forms with end date that has passed
                                           $q3->whereNotNull('tanggal_selesai')
                                             ->where('tanggal_selesai', '<', now());
                                       });
                                   });
                      });
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

        // Hitung statistik dasar
        $totalResponden = $form->respondens()->count();
        $totalPertanyaan = $form->pertanyaan()->count();
        $totalJawaban = \App\Models\Jawaban::whereHas('pertanyaan', function($query) use ($id) {
            $query->where('id_kuesioner', $id);
        })->count();

        // Hitung tingkat penyelesaian
        $completionRate = 0;
        if ($totalPertanyaan > 0 && $totalResponden > 0) {
            $jawabanPerResponden = $totalJawaban / $totalResponden;
            $completionRate = min(100, ($jawabanPerResponden / $totalPertanyaan) * 100);
        }

        // Hitung rata-rata jawaban untuk pertanyaan berskala (1-5)
        $rataRataJawaban = 0;
        $jawabanBerskala = \App\Models\Jawaban::whereHas('pertanyaan', function($query) use ($id) {
            $query->where('id_kuesioner', $id);
        })->avg('jawaban');

        if ($jawabanBerskala !== null) {
            $rataRataJawaban = round($jawabanBerskala, 2);
        }

        // siapkan url sampul (atau null)
        $coverUrl = $form->sampul ? Storage::url($form->sampul) : null;

        return view('Admin.Form.detail-form', [
            'form'             => $form,
            'coverUrl'         => $coverUrl,
            'totalResponden'   => $totalResponden,
            'totalPertanyaan'  => $totalPertanyaan,
            'totalJawaban'     => $totalJawaban,
            'completionRate'   => $completionRate,
            'rataRataJawaban'  => $rataRataJawaban,
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

        // Get all sections with their associated questions
        $sections = $form->section()
            ->with(['pertanyaan' => function($query) {
                $query->orderBy('urutan');
            }])
            ->orderBy('urutan')
            ->get();

        // If no sections exist but questions exist, get all questions directly
        if ($sections->isEmpty()) {
            $questions = $form->pertanyaan()->orderBy('urutan')->get();
            return view('Admin.Form.edit-pertanyaan', compact('form', 'identitas', 'questions'));
        }

        return view('Admin.Form.edit-pertanyaan', compact('form', 'identitas', 'sections'));
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

        // Process questions and sections - first, remove all existing sections and questions for this form
        $form->pertanyaan()->delete(); // Delete all questions first
        $form->section()->delete(); // Delete all sections

        // Then recreate sections and questions from the data
        $urutan = 1;
        $sectionUrutan = 1;

        if (isset($questionsData['sections']) && is_array($questionsData['sections'])) {
            foreach ($questionsData['sections'] as $section) {
                $sectionTitle = $section['title'] ?? 'Section Baru';

                // Create the section
                $sectionRecord = $form->section()->create([
                    'judul' => $sectionTitle,
                    'urutan' => $sectionUrutan++
                ]);

                // Create questions for this section
                if (isset($section['questions']) && is_array($section['questions'])) {
                    foreach ($section['questions'] as $question) {
                        $form->pertanyaan()->create([
                            'id_section' => $sectionRecord->id_section,
                            'teks' => $question['text'],
                            'status_aktif' => $question['required'],
                            'urutan' => $urutan++
                        ]);
                    }
                }
            }
        } else {
            // Fallback: process as before if the new structure isn't used
            foreach ($questionsData as $questionData) {
                $form->pertanyaan()->create([
                    'id_section' => null, // No section
                    'teks' => $questionData['text'],
                    'status_aktif' => $questionData['required'],
                    'urutan' => $urutan++
                ]);
            }
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
        // Ambil hanya survey yang aktif (memperhitungkan status_manual)
        $surveys = \App\Models\Kuesioner::with('kategori')
                    ->where(function ($query) {
                        // Survei dengan status_manual = true (diaktifkan secara manual)
                        $query->where('status_manual', true)
                              // ATAU survei dengan status_manual = null (tidak diatur) DAN logika tanggal menyatakan aktif
                              ->orWhere(function ($subQuery) {
                                  $subQuery->whereNull('status_manual')
                                          ->where(function ($dateSubQuery) {
                                              $dateSubQuery->where(function ($q) {
                                                                  $q->whereNotNull('tanggal_mulai')
                                                                    ->whereNotNull('tanggal_selesai')
                                                                    ->where('tanggal_mulai', '<=', now())
                                                                    ->where('tanggal_selesai', '>=', now());
                                                              })
                                                              ->orWhere(function ($q) {
                                                                  $q->whereNull('tanggal_mulai')
                                                                    ->whereNull('tanggal_selesai');
                                                              })
                                                              ->orWhere(function ($q) {
                                                                  $q->whereNotNull('tanggal_mulai')
                                                                    ->whereNull('tanggal_selesai')
                                                                    ->where('tanggal_mulai', '<=', now());
                                                              })
                                                              ->orWhere(function ($q) {
                                                                  $q->whereNull('tanggal_mulai')
                                                                    ->whereNotNull('tanggal_selesai')
                                                                    ->where('tanggal_selesai', '>=', now());
                                                              });
                                          });
                              });
                    })
                    ->get();

        return view('cari-survey', compact('surveys'));
    }

    public function isiSurvey($id)
    {
        $survey = Kuesioner::with(['kategori', 'pertanyaan.section', 'identitas'])
                    ->where('id_kuesioner', $id)
                    ->where(function ($query) {
                        // Survei dengan status_manual = true (diaktifkan secara manual)
                        $query->where('status_manual', true)
                              // ATAU survei dengan status_manual = null (tidak diatur) DAN logika tanggal menyatakan aktif
                              ->orWhere(function ($subQuery) {
                                  $subQuery->whereNull('status_manual')
                                          ->where(function ($dateSubQuery) {
                                              $dateSubQuery->where(function ($q) {
                                                                  $q->whereNotNull('tanggal_mulai')
                                                                    ->whereNotNull('tanggal_selesai')
                                                                    ->where('tanggal_mulai', '<=', now())
                                                                    ->where('tanggal_selesai', '>=', now());
                                                              })
                                                              ->orWhere(function ($q) {
                                                                  $q->whereNull('tanggal_mulai')
                                                                    ->whereNull('tanggal_selesai');
                                                              })
                                                              ->orWhere(function ($q) {
                                                                  $q->whereNotNull('tanggal_mulai')
                                                                    ->whereNull('tanggal_selesai')
                                                                    ->where('tanggal_mulai', '<=', now());
                                                              })
                                                              ->orWhere(function ($q) {
                                                                  $q->whereNull('tanggal_mulai')
                                                                    ->whereNotNull('tanggal_selesai')
                                                                    ->where('tanggal_selesai', '>=', now());
                                                              });
                                          });
                              });
                    })
                    ->firstOrFail();

        // Get all sections for this survey
        $allSections = $survey->section()->orderBy('urutan')->get();

        // Group questions by section with proper section information
        $questionsGrouped = collect();

        // Add questions that have a section
        foreach($allSections as $section) {
            $sectionQuestions = $survey->pertanyaan->where('id_section', $section->id_section);
            if($sectionQuestions->count() > 0) {
                $questionsGrouped->put($section->judul, $sectionQuestions);
            }
        }

        // Add questions that don't belong to any section (if any)
        $unassignedQuestions = $survey->pertanyaan->whereNull('id_section');
        if($unassignedQuestions->count() > 0) {
            $questionsGrouped->put('Pertanyaan Umum', $unassignedQuestions);
        }

        // Get all sections for passing to view if needed
        $sections = $allSections;

        return view('isi-survey', compact('survey', 'questionsGrouped', 'sections'));
    }

    public function storeJawaban(Request $request, $id)
    {
        // Ambil survey dan cek apakah aktif dengan logika yang konsisten dengan isiSurvey
        $survey = Kuesioner::with(['kategori', 'pertanyaan', 'identitas'])
                    ->where('id_kuesioner', $id)
                    ->where(function ($query) {
                        // Survei dengan status_manual = true (diaktifkan secara manual)
                        $query->where('status_manual', true)
                              // ATAU survei dengan status_manual = null (tidak diatur) DAN logika tanggal menyatakan aktif
                              ->orWhere(function ($subQuery) {
                                  $subQuery->whereNull('status_manual')
                                          ->where(function ($dateSubQuery) {
                                              $dateSubQuery->where(function ($q) {
                                                                  $q->whereNotNull('tanggal_mulai')
                                                                    ->whereNotNull('tanggal_selesai')
                                                                    ->where('tanggal_mulai', '<=', now())
                                                                    ->where('tanggal_selesai', '>=', now());
                                                              })
                                                              ->orWhere(function ($q) {
                                                                  $q->whereNull('tanggal_mulai')
                                                                    ->whereNull('tanggal_selesai');
                                                              })
                                                              ->orWhere(function ($q) {
                                                                  $q->whereNotNull('tanggal_mulai')
                                                                    ->whereNull('tanggal_selesai')
                                                                    ->where('tanggal_mulai', '<=', now());
                                                              })
                                                              ->orWhere(function ($q) {
                                                                  $q->whereNull('tanggal_mulai')
                                                                    ->whereNotNull('tanggal_selesai')
                                                                    ->where('tanggal_selesai', '>=', now());
                                                              });
                                          });
                              });
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
            // Ambil semua ID pertanyaan yang valid untuk form ini
            $validQuestionIds = $survey->pertanyaan->pluck('id_pertanyaan')->toArray();

            foreach ($request->jawaban as $id_pertanyaan => $isi_jawaban) {
                // Pastikan id_pertanyaan adalah angka (bukan 0 yang digunakan untuk identitas)
                if ($id_pertanyaan != 0) {
                    // Pastikan id_pertanyaan terkait dengan survey ini
                    if (in_array($id_pertanyaan, $validQuestionIds)) {
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

    public function updateManualStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|boolean',
        ]);

        $form = Kuesioner::findOrFail($id);
        $form->update(['status_manual' => $request->status]);

        return response()->json([
            'success' => true,
            'message' => 'Status berhasil diperbarui',
            'status' => $request->status ? 'aktif' : 'nonaktif'
        ]);
    }

    public function checkDuplicate(Request $request, $id)
    {
        $survey = Kuesioner::with('identitas')->findOrFail($id);

        // Check if identitas configuration exists
        if (!$survey->identitas) {
            return response()->json(['exists' => false]);
        }

        // Build query for checking duplicates
        $query = Responden::where('id_kuesioner', $id);

        $hasIdentity = false;

        // Check for any required identity fields based on configuration
        if ($survey->identitas->wajib1 && $request->identitas1) {
            $query->where('identitas1', $request->identitas1);
            $hasIdentity = true;
        } elseif ($request->identitas1 && ($survey->identitas->atribut1 && strlen($request->identitas1) > 0)) {
            // Even if not required, if provided, check for it
            $query->where('identitas1', $request->identitas1);
            $hasIdentity = true;
        }

        if ($survey->identitas->wajib2 && $request->identitas2) {
            $query->where('identitas2', $request->identitas2);
            $hasIdentity = true;
        } elseif ($request->identitas2 && ($survey->identitas->atribut2 && strlen($request->identitas2) > 0)) {
            $query->where('identitas2', $request->identitas2);
            $hasIdentity = true;
        }

        if ($survey->identitas->wajib3 && $request->identitas3) {
            $query->where('identitas3', $request->identitas3);
            $hasIdentity = true;
        } elseif ($request->identitas3 && ($survey->identitas->atribut3 && strlen($request->identitas3) > 0)) {
            $query->where('identitas3', $request->identitas3);
            $hasIdentity = true;
        }

        if ($survey->identitas->wajib4 && $request->identitas4) {
            $query->where('identitas4', $request->identitas4);
            $hasIdentity = true;
        } elseif ($request->identitas4 && ($survey->identitas->atribut4 && strlen($request->identitas4) > 0)) {
            $query->where('identitas4', $request->identitas4);
            $hasIdentity = true;
        }

        if ($survey->identitas->wajib5 && $request->identitas5) {
            $query->where('identitas5', $request->identitas5);
            $hasIdentity = true;
        } elseif ($request->identitas5 && ($survey->identitas->atribut5 && strlen($request->identitas5) > 0)) {
            $query->where('identitas5', $request->identitas5);
            $hasIdentity = true;
        }

        // Only check for duplicates if at least one identity field is provided
        $exists = $hasIdentity ? $query->exists() : false;

        return response()->json(['exists' => $exists]);
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

    public function getJawabanDistribusi($id)
    {
        $distribusi = \App\Models\Jawaban::whereHas('pertanyaan', function($query) use ($id) {
            $query->where('id_kuesioner', $id);
        })
        ->selectRaw('jawaban, COUNT(*) as count')
        ->groupBy('jawaban')
        ->orderBy('jawaban')
        ->pluck('count', 'jawaban');

        // Initialize distribution array with zeros for scores 1-5
        $distribusiArray = [0, 0, 0, 0, 0];

        // Map the actual values from the database
        if ($distribusi) {
            foreach ($distribusi as $skor => $jumlah) {
                // Adjust index for 0-based array (skor 1 -> index 0)
                if ($skor >= 1 && $skor <= 5) {
                    $distribusiArray[$skor - 1] = $jumlah;
                }
            }
        }

        return response()->json([
            'distribusi' => $distribusiArray,
            'total' => array_sum($distribusiArray)
        ]);
    }

    public function exportLaporan($id, $format)
    {
        $form = Kuesioner::with(['kategori', 'section.pertanyaan', 'identitas', 'respondens.jawaban.pertanyaan'])->findOrFail($id);

        // Get all sections with their questions
        $sections = $form->section()->with('pertanyaan')->orderBy('urutan')->get();

        // If no sections exist, get all questions directly
        if ($sections->isEmpty()) {
            $questions = $form->pertanyaan()->orderBy('urutan')->get();
            $sections = collect([
                (object) [
                    'judul' => 'Pertanyaan Umum',
                    'questions' => $questions
                ]
            ]);
        } else {
            // Transform to include questions in each section
            $sections = $sections->map(function ($section) {
                return [
                    'judul' => $section->judul,
                    'questions' => $section->pertanyaan->sortBy('urutan')
                ];
            });
        }

        // Get responden data with answers
        $respondens = $form->respondens()->with('jawaban.pertanyaan')->get();

        // Prepare statistics for all questions
        $allQuestions = collect();
        foreach($sections as $section) {
            foreach($section['questions'] as $question) {
                $allQuestions->push($question);
            }
        }

        // Calculate statistics for each question
        $questionStats = [];
        foreach($allQuestions as $question) {
            $answers = $respondens->pluck('jawaban')->flatten()
                ->where('id_pertanyaan', $question->id_pertanyaan)
                ->pluck('jawaban');

            $stats = [
                'count' => $answers->count(),
                'avg' => $answers->count() > 0 ? $answers->avg() : 0,
                'distribution' => [
                    1 => 0,
                    2 => 0,
                    3 => 0,
                    4 => 0,
                    5 => 0,
                ]
            ];

            // Calculate distribution more explicitly
            foreach($answers as $answer) {
                $answerScore = (int) $answer;  // Ensure it's treated as integer
                if($answerScore >= 1 && $answerScore <= 5) {
                    $stats['distribution'][$answerScore]++;
                }
            }

            $questionStats[$question->id_pertanyaan] = $stats;
        }

        // Prepare data for export
        $exportData = [
            'form' => $form,
            'sections' => $sections,
            'respondens' => $respondens,
            'questionStats' => $questionStats,
            'totalResponden' => $respondens->count(),
            'totalQuestions' => $allQuestions->count(),
            'identitasConfig' => $form->identitas
        ];

        // Generate the export based on format
        if (strtolower($format) === 'pdf') {
            return $this->generatePdfReport($exportData);
        } elseif (strtolower($format) === 'xlsx') {
            return $this->generateExcelReport($exportData);
        } else {
            abort(404, 'Format not supported');
        }
    }

    private function generatePdfReport($data)
    {
        // Add the full URL to the data for use in PDF
        $data['fullUrl'] = request()->getSchemeAndHttpHost();

        $pdf = \PDF::loadView('Admin.Form.export.pdf-report', $data);
        return $pdf->download('laporan-form-' . $data['form']->id_kuesioner . '.pdf');
    }

    private function generateExcelReport($data)
    {
        return \Maatwebsite\Excel\Facades\Excel::download(
            new \App\Exports\FormReportExport($data),
            'laporan-form-' . $data['form']->id_kuesioner . '.xlsx'
        );
    }
}
