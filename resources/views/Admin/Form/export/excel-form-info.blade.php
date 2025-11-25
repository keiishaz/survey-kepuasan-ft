@php
/** @var \App\Models\Kuesioner $form */
/** @var \Illuminate\Support\Collection $sections */
/** @var array $questionStats */
/** @var \Illuminate\Support\Collection $respondens */
/** @var int $totalResponden */
/** @var int $totalQuestions */
/** @var \App\Models\KonfigurasiIdentitas|null $identitasConfig */
@endphp
<table>
    <thead>
        <tr>
            <th colspan="2" style="font-weight: bold; font-size: 14px;">LAPORAN FORM - {{ $form->nama }}</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><strong>Nama Form</strong></td>
            <td>{{ $form->nama }}</td>
        </tr>
        <tr>
            <td><strong>Kategori</strong></td>
            <td>{{ $form->kategori ? $form->kategori->nama : 'Umum' }}</td>
        </tr>
        <tr>
            <td><strong>Deskripsi</strong></td>
            <td>{{ $form->deskripsi ?? '-' }}</td>
        </tr>
        <tr>
            <td><strong>Dibuat oleh</strong></td>
            <td>{{ $form->created_by ?? '-' }}</td>
        </tr>
        <tr>
            <td><strong>Tanggal Dibuat</strong></td>
            <td>{{ $form->created_at ? (is_string($form->created_at) ? \Carbon\Carbon::parse($form->created_at)->format('d-m-Y H:i') : $form->created_at->format('d-m-Y H:i')) : '-' }}</td>
        </tr>
        <tr>
            <td><strong>Periode</strong></td>
            <td>
                {{ $form->tanggal_mulai ? (is_string($form->tanggal_mulai) ? \Carbon\Carbon::parse($form->tanggal_mulai)->format('d-m-Y') : $form->tanggal_mulai->format('d-m-Y')) : 'Tidak ditentukan' }}
                s.d
                {{ $form->tanggal_selesai ? (is_string($form->tanggal_selesai) ? \Carbon\Carbon::parse($form->tanggal_selesai)->format('d-m-Y') : $form->tanggal_selesai->format('d-m-Y')) : 'Tidak ditentukan' }}
            </td>
        </tr>
        <tr>
            <td><strong>Total Responden</strong></td>
            <td>{{ $totalResponden }}</td>
        </tr>
        <tr>
            <td><strong>Total Pertanyaan</strong></td>
            <td>{{ $totalQuestions }}</td>
        </tr>
        <tr>
            <td><strong>Tingkat Penyelesaian</strong></td>
            <td>
                @if($totalResponden > 0 && $totalQuestions > 0)
                    {{ round(($respondens->sum(function($respon) use ($totalQuestions) {
                        return $respon->jawaban->count();
                    }) / ($totalResponden * $totalQuestions)) * 100, 2) }}%
                @else
                    0%
                @endif
            </td>
        </tr>
        <tr>
            <td><strong>Rata-rata Jawaban</strong></td>
            <td>
                @if($respondens->count() > 0)
                    {{ round($respondens->avg(function($respon) {
                        return $respon->jawaban->avg('jawaban');
                    }), 2) }}
                @else
                    0.00
                @endif
            </td>
        </tr>
    </tbody>
</table>

@if($identitasConfig)
    <table style="margin-top: 20px;">
        <thead>
            <tr>
                <th colspan="2" style="font-weight: bold;">Konfigurasi Identitas</th>
            </tr>
        </thead>
        <tbody>
            @if($identitasConfig->atribut1)
                <tr>
                    <td><strong>{{ $identitasConfig->atribut1 }}</strong></td>
                    <td>{{ $identitasConfig->wajib1 ? 'Wajib' : 'Tidak Wajib' }}</td>
                </tr>
            @endif
            @if($identitasConfig->atribut2)
                <tr>
                    <td><strong>{{ $identitasConfig->atribut2 }}</strong></td>
                    <td>{{ $identitasConfig->wajib2 ? 'Wajib' : 'Tidak Wajib' }}</td>
                </tr>
            @endif
            @if($identitasConfig->atribut3)
                <tr>
                    <td><strong>{{ $identitasConfig->atribut3 }}</strong></td>
                    <td>{{ $identitasConfig->wajib3 ? 'Wajib' : 'Tidak Wajib' }}</td>
                </tr>
            @endif
            @if($identitasConfig->atribut4)
                <tr>
                    <td><strong>{{ $identitasConfig->atribut4 }}</strong></td>
                    <td>{{ $identitasConfig->wajib4 ? 'Wajib' : 'Tidak Wajib' }}</td>
                </tr>
            @endif
            @if($identitasConfig->atribut5)
                <tr>
                    <td><strong>{{ $identitasConfig->atribut5 }}</strong></td>
                    <td>{{ $identitasConfig->wajib5 ? 'Wajib' : 'Tidak Wajib' }}</td>
                </tr>
            @endif
        </tbody>
    </table>
@endif

@foreach($sections as $sectionIndex => $section)
    <table style="margin-top: 20px;">
        <thead>
            <tr>
                <th colspan="7" style="font-weight: bold;">Bagian {{ $sectionIndex + 1 }}: {{ $section['judul'] ?? 'Pertanyaan Umum' }}</th>
            </tr>
            <tr>
                <th>No</th>
                <th>Pertanyaan</th>
                <th>Total Jawaban</th>
                <th>Rata-rata Jawaban</th>
                <th>Skor 1</th>
                <th>Skor 2</th>
                <th>Skor 3</th>
                <th>Skor 4</th>
                <th>Skor 5</th>
            </tr>
        </thead>
        <tbody>
            @foreach($section['questions'] as $question)
                @php
                    $stats = $questionStats[$question->id_pertanyaan] ?? null;
                @endphp
                @if($stats)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $question->teks }}</td>
                        <td>{{ $stats['count'] }}</td>
                        <td>{{ number_format($stats['avg'], 2) }}</td>
                        <td>{{ $stats['distribution'][1] }}</td>
                        <td>{{ $stats['distribution'][2] }}</td>
                        <td>{{ $stats['distribution'][3] }}</td>
                        <td>{{ $stats['distribution'][4] }}</td>
                        <td>{{ $stats['distribution'][5] }}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
@endforeach