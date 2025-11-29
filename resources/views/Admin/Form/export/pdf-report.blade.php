<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Form - {{ $form->nama }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            line-height: 1.6;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #3b82f6;
        }
        .header h1 {
            font-size: 24px;
            margin: 0;
            color: #1e40af;
        }
        .header h2 {
            font-size: 20px;
            margin: 10px 0 0 0;
            color: #374151;
        }
        .info-section {
            margin-bottom: 20px;
        }
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }
        .stat-card {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 12px;
        }
        .stat-value {
            font-size: 20px;
            font-weight: bold;
            color: #1e40af;
            text-align: center;
        }
        .stat-label {
            font-size: 12px;
            color: #6b7280;
            text-align: center;
            margin-top: 5px;
        }
        .section-title {
            background: #e0f2fe;
            padding: 8px 12px;
            border-left: 4px solid #0ea5e9;
            font-size: 16px;
            font-weight: bold;
            margin: 20px 0 10px 0;
        }
        .question-item {
            margin-bottom: 10px;
            padding: 8px 0;
            border-bottom: 1px solid #e5e7eb;
        }
        .question-text {
            font-weight: bold;
            margin-bottom: 5px;
            color: #1f2937;
        }
        .question-stats {
            font-size: 12px;
            color: #6b7280;
        }
        .distribution {
            display: flex;
            margin-top: 5px;
        }
        .distribution-bar {
            display: flex;
            align-items: center;
            margin-right: 15px;
        }
        .distribution-label {
            margin-right: 5px;
        }
        .distribution-bar-inner {
            height: 12px;
            background: #d1d5db;
            border-radius: 6px;
            overflow: hidden;
        }
        .distribution-bar-fill {
            height: 100%;
            background: #3b82f6;
        }
        .page-break {
            page-break-before: always;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            color: #6b7280;
            border-top: 1px solid #e5e7eb;
            padding-top: 15px;
        }
        .cover-image {
            text-align: center;
            margin-bottom: 20px;
        }
        .cover-image img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <div class="header">
        @if($form->sampul)
            <div class="cover-image">
                @php
                    $imagePath = public_path('uploadedfiles/' . $form->sampul);
                    $imageData = null;
                    if (file_exists($imagePath)) {
                        $imageData = base64_encode(file_get_contents($imagePath));
                        $mimeType = mime_content_type($imagePath);
                    }
                @endphp
                @if($imageData)
                    <img src="data:{{ $mimeType }};base64,{{ $imageData }}" alt="Cover Image" />
                @else
                    <img src="{{ request()->getSchemeAndHttpHost() . '/uploadedfiles/' . $form->sampul }}" alt="Cover Image" />
                @endif
            </div>
        @endif
        <h1>Laporan Survei Kepuasan</h1>
        <h2>{{ $form->nama }}</h2>
        <p style="color: #6b7280; margin-top: 5px;">{{ $form->kategori ? $form->kategori->nama : 'Umum' }}</p>
    </div>

    <div class="info-section">
        <h3 style="font-size: 18px; color: #1f2937; margin-bottom: 15px; border-bottom: 1px solid #e5e7eb; padding-bottom: 5px;">Ringkasan Survei</h3>

        <div class="info-grid">
            <div class="stat-card">
                <div class="stat-value">{{ $totalResponden }}</div>
                <div class="stat-label">Total Responden</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">{{ $totalQuestions }}</div>
                <div class="stat-label">Jumlah Pertanyaan</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">
                    @if($totalResponden > 0 && $totalQuestions > 0)
                        {{ round(($respondens->sum(function($respon) use ($totalQuestions) {
                            return $respon->jawaban->count();
                        }) / ($totalResponden * $totalQuestions)) * 100, 1) }}%
                    @else
                        0%
                    @endif
                </div>
                <div class="stat-label">Tingkat Penyelesaian</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">
                    @if($respondens->count() > 0)
                        {{ round($respondens->avg(function($respon) {
                            return $respon->jawaban->avg('jawaban');
                        }), 2) }}
                    @else
                        0.00
                    @endif
                </div>
                <div class="stat-label">Rata-rata Jawaban</div>
            </div>
        </div>

        <div style="margin-top: 15px;">
            <p><strong>Deskripsi:</strong> {{ $form->deskripsi ?? '-' }}</p>
            <p><strong>Dibuat oleh:</strong> {{ $form->created_by ?? '-' }}</p>
            <p><strong>Tanggal Dibuat:</strong> {{ $form->created_at ? (is_string($form->created_at) ? \Carbon\Carbon::parse($form->created_at)->format('d M Y H:i') : $form->created_at->format('d M Y H:i')) : '-' }}</p>
            @if($form->tanggal_mulai || $form->tanggal_selesai)
                <p>
                    <strong>Periode:</strong>
                    {{ $form->tanggal_mulai ? (is_string($form->tanggal_mulai) ? \Carbon\Carbon::parse($form->tanggal_mulai)->format('d M Y') : $form->tanggal_mulai->format('d M Y')) : 'Tidak ditentukan' }}
                    s.d
                    {{ $form->tanggal_selesai ? (is_string($form->tanggal_selesai) ? \Carbon\Carbon::parse($form->tanggal_selesai)->format('d M Y') : $form->tanggal_selesai->format('d M Y')) : 'Tidak ditentukan' }}
                </p>
            @endif
        </div>
    </div>

    @if($identitasConfig)
        <div class="info-section">
            <h3 style="font-size: 18px; color: #1f2937; margin-bottom: 15px; border-bottom: 1px solid #e5e7eb; padding-bottom: 5px;">Konfigurasi Identitas</h3>
            <div style="margin-left: 20px;">
                @if($identitasConfig->atribut1)
                    <p><strong>{{ $identitasConfig->atribut1 }}:</strong> @if($identitasConfig->wajib1) <span style="color: red;">(Wajib)</span> @endif</p>
                @endif
                @if($identitasConfig->atribut2)
                    <p><strong>{{ $identitasConfig->atribut2 }}:</strong> @if($identitasConfig->wajib2) <span style="color: red;">(Wajib)</span> @endif</p>
                @endif
                @if($identitasConfig->atribut3)
                    <p><strong>{{ $identitasConfig->atribut3 }}:</strong> @if($identitasConfig->wajib3) <span style="color: red;">(Wajib)</span> @endif</p>
                @endif
                @if($identitasConfig->atribut4)
                    <p><strong>{{ $identitasConfig->atribut4 }}:</strong> @if($identitasConfig->wajib4) <span style="color: red;">(Wajib)</span> @endif</p>
                @endif
                @if($identitasConfig->atribut5)
                    <p><strong>{{ $identitasConfig->atribut5 }}:</strong> @if($identitasConfig->wajib5) <span style="color: red;">(Wajib)</span> @endif</p>
                @endif
            </div>
        </div>
    @endif

    <div class="info-section">
        <h3 style="font-size: 18px; color: #1f2937; margin-bottom: 15px; border-bottom: 1px solid #e5e7eb; padding-bottom: 5px;">Statistik Jawaban</h3>

        @foreach($sections as $section)
            <div class="section-title">{{ $section['judul'] ?? 'Pertanyaan Umum' }}</div>

            @foreach($section['questions'] as $question)
                @php
                    $stats = $questionStats[$question->id_pertanyaan] ?? null;
                @endphp
                @if($stats)
                    <div class="question-item">
                        <div class="question-text">{{ $loop->iteration }}. {{ $question->teks }}</div>
                        <div class="question-stats">
                            <div style="margin-bottom: 5px;">
                                <strong>Total Jawaban:</strong> {{ $stats['count'] }}
                                | <strong>Rata-rata:</strong> {{ number_format($stats['avg'], 2) }}
                            </div>

                            <div class="distribution">
                                @foreach($stats['distribution'] as $score => $count)
                                    @if($count > 0)
                                        <div class="distribution-bar">
                                            <span class="distribution-label">{{ $score }}:</span>
                                            <div class="distribution-bar-inner" style="width: 60px;">
                                                <div class="distribution-bar-fill" style="width: {{ ($count / max(array_sum($stats['distribution']), 1)) * 100 }}%;"></div>
                                            </div>
                                            <span style="margin-left: 3px;">{{ $count }}</span>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @endforeach
    </div>

    <div class="info-section">
        <h3 style="font-size: 18px; color: #1f2937; margin-bottom: 15px; border-bottom: 1px solid #e5e7eb; padding-bottom: 5px;">Rekap Responden</h3>
        <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
            <thead>
                <tr style="background-color: #f3f4f6;">
                    <th style="border: 1px solid #d1d5db; padding: 8px; text-align: left;">No</th>
                    @if($identitasConfig && $identitasConfig->atribut1)
                        <th style="border: 1px solid #d1d5db; padding: 8px; text-align: left;">{{ $identitasConfig->atribut1 }}</th>
                    @endif
                    @if($identitasConfig && $identitasConfig->atribut2)
                        <th style="border: 1px solid #d1d5db; padding: 8px; text-align: left;">{{ $identitasConfig->atribut2 }}</th>
                    @endif
                    @if($identitasConfig && $identitasConfig->atribut3)
                        <th style="border: 1px solid #d1d5db; padding: 8px; text-align: left;">{{ $identitasConfig->atribut3 }}</th>
                    @endif
                    @if($identitasConfig && $identitasConfig->atribut4)
                        <th style="border: 1px solid #d1d5db; padding: 8px; text-align: left;">{{ $identitasConfig->atribut4 }}</th>
                    @endif
                    @if($identitasConfig && $identitasConfig->atribut5)
                        <th style="border: 1px solid #d1d5db; padding: 8px; text-align: left;">{{ $identitasConfig->atribut5 }}</th>
                    @endif
                    <th style="border: 1px solid #d1d5db; padding: 8px; text-align: left;">Waktu Submit</th>
                </tr>
            </thead>
            <tbody>
                @forelse($respondens as $index => $respon)
                    <tr>
                        <td style="border: 1px solid #d1d5db; padding: 6px;">{{ $index + 1 }}</td>
                        @if($identitasConfig && $identitasConfig->atribut1)
                            <td style="border: 1px solid #d1d5db; padding: 6px;">{{ $respon->identitas1 ?? '-' }}</td>
                        @endif
                        @if($identitasConfig && $identitasConfig->atribut2)
                            <td style="border: 1px solid #d1d5db; padding: 6px;">{{ $respon->identitas2 ?? '-' }}</td>
                        @endif
                        @if($identitasConfig && $identitasConfig->atribut3)
                            <td style="border: 1px solid #d1d5db; padding: 6px;">{{ $respon->identitas3 ?? '-' }}</td>
                        @endif
                        @if($identitasConfig && $identitasConfig->atribut4)
                            <td style="border: 1px solid #d1d5db; padding: 6px;">{{ $respon->identitas4 ?? '-' }}</td>
                        @endif
                        @if($identitasConfig && $identitasConfig->atribut5)
                            <td style="border: 1px solid #d1d5db; padding: 6px;">{{ $respon->identitas5 ?? '-' }}</td>
                        @endif
                        <td style="border: 1px solid #d1d5db; padding: 6px;">{{ $respon->waktu_submit ? (is_string($respon->waktu_submit) ? \Carbon\Carbon::parse($respon->waktu_submit)->format('d M Y H:i') : $respon->waktu_submit->format('d M Y H:i')) : '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" style="border: 1px solid #d1d5db; padding: 12px; text-align: center;">Tidak ada data responden</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="footer">
        <p>Laporan ini dibuat secara otomatis oleh sistem SIPULAS - Sistem Survey Kepuasan Layanan</p>
        <p>Dicetak pada: {{ now()->format('d M Y H:i:s') }}</p>
    </div>
</body>
</html>