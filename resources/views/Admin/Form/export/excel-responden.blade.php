@php
/** @var \App\Models\Kuesioner $form */
/** @var \Illuminate\Support\Collection $respondens */
/** @var \Illuminate\Support\Collection $sections */
/** @var array $questionStats */
/** @var \App\Models\KonfigurasiIdentitas|null $identitasConfig */
@endphp
<table>
    <thead>
        <tr>
            <th colspan="10" style="font-weight: bold; font-size: 14px;">DATA RESPONDEN - {{ $form->nama }}</th>
        </tr>
        <tr>
            <th>No</th>
            @if($identitasConfig && $identitasConfig->atribut1)
                <th>{{ $identitasConfig->atribut1 }}</th>
            @endif
            @if($identitasConfig && $identitasConfig->atribut2)
                <th>{{ $identitasConfig->atribut2 }}</th>
            @endif
            @if($identitasConfig && $identitasConfig->atribut3)
                <th>{{ $identitasConfig->atribut3 }}</th>
            @endif
            @if($identitasConfig && $identitasConfig->atribut4)
                <th>{{ $identitasConfig->atribut4 }}</th>
            @endif
            @if($identitasConfig && $identitasConfig->atribut5)
                <th>{{ $identitasConfig->atribut5 }}</th>
            @endif
            <th>Waktu Submit</th>
        </tr>
    </thead>
    <tbody>
        @forelse($respondens as $index => $respon)
            <tr>
                <td>{{ $index + 1 }}</td>
                @if($identitasConfig && $identitasConfig->atribut1)
                    <td>{{ $respon->identitas1 ?? '-' }}</td>
                @endif
                @if($identitasConfig && $identitasConfig->atribut2)
                    <td>{{ $respon->identitas2 ?? '-' }}</td>
                @endif
                @if($identitasConfig && $identitasConfig->atribut3)
                    <td>{{ $respon->identitas3 ?? '-' }}</td>
                @endif
                @if($identitasConfig && $identitasConfig->atribut4)
                    <td>{{ $respon->identitas4 ?? '-' }}</td>
                @endif
                @if($identitasConfig && $identitasConfig->atribut5)
                    <td>{{ $respon->identitas5 ?? '-' }}</td>
                @endif
                <td>{{ $respon->waktu_submit ? (is_string($respon->waktu_submit) ? \Carbon\Carbon::parse($respon->waktu_submit)->format('d-m-Y H:i:s') : $respon->waktu_submit->format('d-m-Y H:i:s')) : '-' }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="10">Tidak ada data responden</td>
            </tr>
        @endforelse
    </tbody>
</table>

@foreach($sections as $sectionIndex => $section)
    <table style="margin-top: 20px;">
        <thead>
            <tr>
                <th colspan="10" style="font-weight: bold;">JAWABAN - Bagian {{ $sectionIndex + 1 }}: {{ $section['judul'] ?? 'Pertanyaan Umum' }}</th>
            </tr>
            <tr>
                <th>Responden</th>
                @foreach($section['questions'] as $question)
                    <th>{{ $question->teks }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @forelse($respondens as $responIndex => $respon)
                <tr>
                    <td>Responden {{ $responIndex + 1 }}</td>
                    @foreach($section['questions'] as $question)
                        @php
                            $jawaban = $respon->jawaban->firstWhere('id_pertanyaan', $question->id_pertanyaan);
                        @endphp
                        <td>{{ $jawaban ? $jawaban->jawaban : '-' }}</td>
                    @endforeach
                </tr>
            @empty
                <tr>
                    <td colspan="{{ count($section['questions']) + 1 }}">Tidak ada data responden</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endforeach