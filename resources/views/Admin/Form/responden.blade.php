<!DOCTYPE html>
<html lang="id">
<head>
    @include('partials.head')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>SIPULAS - Responden {{ $form->nama }}</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        }
        .stat-card {
            background: white;
            border: 1px solid #E5E7EB;
            border-radius: 12px;
            padding: 16px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 16px;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05);
        }
        .stat-card:hover {
            border-color: #3B82F6;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
        }
        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .stat-text {
            flex: 1;
        }
        .stat-value {
            font-size: 24px;
            font-weight: 700;
            color: #1E3A8A;
            margin: 0;
        }
        .stat-label {
            font-size: 12px;
            color: #6B7280;
            font-weight: 500;
            margin: 0;
        }
        .responden-card {
            background: white;
            border: 1px solid #E5E7EB;
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 12px;
            transition: all 0.3s ease;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05);
        }
        .responden-card:hover {
            border-color: #3B82F6;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
        }
        .jawaban-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 6px 0;
            border-bottom: 1px solid #F3F4F6;
        }
        .jawaban-item:last-child {
            border-bottom: none;
        }
        .skala-indicator {
            display: flex;
            gap: 4px;
            align-items: center;
        }
        .skala-dot {
            width: 14px;
            height: 14px;
            border-radius: 50%;
        }
        .skala-indicator {
            display: flex;
            gap: 4px;
            align-items: center;
        }
        .skala-1 { background-color: #EF4444; } /* Merah untuk 1 */
        .skala-2 { background-color: #F97316; } /* Oranye untuk 2 */
        .skala-3 { background-color: #EAB308; } /* Kuning untuk 3 */
        .skala-4 { background-color: #22C55E; } /* Hijau untuk 4 */
        .skala-5 { background-color: #10B981; } /* Hijau muda (emerald) untuk 5 */
        .skala-text-1 { color: #EF4444; } /* Merah untuk 1 */
        .skala-text-2 { color: #F97316; } /* Oranye untuk 2 */
        .skala-text-3 { color: #EAB308; } /* Kuning untuk 3 */
        .skala-text-4 { color: #22C55E; } /* Hijau untuk 4 */
        .skala-text-5 { color: #10B981; } /* Hijau muda (emerald) untuk 5 */
        .responden-container {
            max-height: 400px;
            overflow-y: auto;
            padding-right: 8px;
            border-radius: 0.75rem;
        }
        .responden-container::-webkit-scrollbar {
            width: 8px;
        }
        .responden-container::-webkit-scrollbar-track {
            background: linear-gradient(to bottom, #F0F9FF, #E0F2FE);
            border-radius: 10px;
            margin: 4px 0;
        }
        .responden-container::-webkit-scrollbar-thumb {
            background: linear-gradient(to bottom, #93C5FD, #60A5FA);
            border-radius: 10px;
            border: 1px solid #BFDBFE;
        }
        .responden-container::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(to bottom, #60A5FA, #3B82F6);
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="flex min-h-screen">
        @include('Admin.navbar')

        <!-- Mobile Sidebar Toggle -->
        <button class="fixed top-4 right-4 z-50 lg:hidden bg-white p-2.5 rounded-lg shadow-md border border-gray-200" id="sidebar-toggle">
            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>

        <!-- Main Content -->
        <main class="flex-1 lg:ml-64 p-6 lg:p-8">
            <!-- Header -->
            <div class="mb-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('forms.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Manajemen Form</a>
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                        <a href="{{ route('forms.show', $form->id_kuesioner) }}" class="text-sm text-gray-600 hover:text-gray-900">{{ $form->nama }}</a>
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                        <span class="text-sm text-gray-900 font-medium">Responden</span>
                    </div>
                    <div>
                        <a href="{{ route('forms.export-respon', $form->id_kuesioner) }}" class="px-4 py-2 bg-white border border-gray-200 text-gray-900 font-medium rounded-lg text-sm hover:bg-gray-50 transition-colors flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Ekspor Responden
                        </a>
                    </div>
                </div>
            </div>

            <!-- Analytics Section -->
            <div class="mb-8">
                <h2 class="text-base font-bold text-gray-900 mb-4">Statistik Responden</h2>

                <!-- Stats Horizontal -->
                <div class="space-y-3">
                    <!-- Total Responden -->
                    <div class="stat-card">
                        <div class="stat-icon" style="background-color: #F3E8FF;">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 10a3 3 0 11-6 0 3 3 0 016 0zM16 16a5 5 0 10-10 0 5 5 0 0010 0z"></path>
                            </svg>
                        </div>
                        <div class="stat-text">
                            <div class="stat-label">Total Responden</div>
                            <div class="stat-value">{{ $totalResponden }}</div>
                            <div class="text-xs text-gray-500">Jumlah responden keseluruhan</div>
                        </div>
                    </div>

                    <!-- Total Pertanyaan -->
                    <div class="stat-card">
                        <div class="stat-icon" style="background-color: #DBEAFE;">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="stat-text">
                            <div class="stat-label">Total Pertanyaan</div>
                            <div class="stat-value">{{ $form->pertanyaan->count() }}</div>
                            <div class="text-xs text-gray-500">Jumlah pertanyaan dalam survey</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Identitas Section -->
            <div class="mb-8">
                <h2 class="text-base font-bold text-gray-900 mb-4">Konfigurasi Identitas</h2>
                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-6 border border-blue-100 shadow-sm">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @if($form->identitas)
                            @if($form->identitas->atribut1)
                                <div class="p-2 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg border border-blue-100">
                                    <div class="text-xs text-blue-700 font-medium">Atribut 1</div>
                                    <div class="text-xs text-gray-900">{{ $form->identitas->atribut1 }}</div>
                                    <div class="text-xs text-gray-600">Wajib: {{ $form->identitas->wajib1 ? 'Ya' : 'Tidak' }}</div>
                                </div>
                            @endif
                            @if($form->identitas->atribut2)
                                <div class="p-2 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg border border-blue-100">
                                    <div class="text-xs text-blue-700 font-medium">Atribut 2</div>
                                    <div class="text-xs text-gray-900">{{ $form->identitas->atribut2 }}</div>
                                    <div class="text-xs text-gray-600">Wajib: {{ $form->identitas->wajib2 ? 'Ya' : 'Tidak' }}</div>
                                </div>
                            @endif
                            @if($form->identitas->atribut3)
                                <div class="p-2 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg border border-blue-100">
                                    <div class="text-xs text-blue-700 font-medium">Atribut 3</div>
                                    <div class="text-xs text-gray-900">{{ $form->identitas->atribut3 }}</div>
                                    <div class="text-xs text-gray-600">Wajib: {{ $form->identitas->wajib3 ? 'Ya' : 'Tidak' }}</div>
                                </div>
                            @endif
                            @if($form->identitas->atribut4)
                                <div class="p-2 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg border border-blue-100">
                                    <div class="text-xs text-blue-700 font-medium">Atribut 4</div>
                                    <div class="text-xs text-gray-900">{{ $form->identitas->atribut4 }}</div>
                                    <div class="text-xs text-gray-600">Wajib: {{ $form->identitas->wajib4 ? 'Ya' : 'Tidak' }}</div>
                                </div>
                            @endif
                            @if($form->identitas->atribut5)
                                <div class="p-2 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg border border-blue-100">
                                    <div class="text-xs text-blue-700 font-medium">Atribut 5</div>
                                    <div class="text-xs text-gray-900">{{ $form->identitas->atribut5 }}</div>
                                    <div class="text-xs text-gray-600">Wajib: {{ $form->identitas->wajib5 ? 'Ya' : 'Tidak' }}</div>
                                </div>
                            @endif
                        @else
                            <div class="col-span-full text-center py-8">
                                <p class="text-gray-500">Tidak ada konfigurasi identitas untuk form ini</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Responden Section -->
            <div class="mb-8">
                <h2 class="text-base font-bold text-gray-900 mb-4">Data Responden ({{ $totalResponden }})</h2>
                @if($respondens->count() > 0)
                    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-6 border border-blue-100 shadow-sm">
                        <div class="responden-container">
                            @foreach($respondens as $responden)
                            <div class="responden-card bg-white shadow-sm rounded-xl border border-gray-200 transition-all duration-300 hover:shadow-md">
                                <div class="flex justify-between items-center mb-3">
                                    <div class="flex items-center space-x-3">
                                        <div class="bg-blue-100 p-2 rounded-lg">
                                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                        <h3 class="text-sm font-medium text-gray-900">Responden #{{ $responden->id_respon }}</h3>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <div class="h-2 w-2 bg-green-500 rounded-full"></div>
                                        <span class="text-xs text-gray-700">{{ $responden->waktu_submit ? \Carbon\Carbon::parse($responden->waktu_submit)->format('d M Y, H:i') : 'Belum selesai' }}</span>
                                    </div>
                                </div>

                                <!-- Identitas Responden -->
                                <div class="mb-4 border-b border-gray-100 pb-3">
                                    <div class="flex items-center mb-2">
                                        <svg class="w-4 h-4 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        <h4 class="text-xs font-medium text-gray-700">Identitas:</h4>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2">
                                        @if($responden->identitas1)
                                            <div class="p-2 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg border border-blue-100">
                                                <div class="text-xs text-blue-700 font-medium">
                                                    @if($form->identitas && $form->identitas->atribut1)
                                                        {{ $form->identitas->atribut1 }}
                                                    @else
                                                        Atribut 1
                                                    @endif
                                                </div>
                                                <div class="text-xs text-gray-900">{{ $responden->identitas1 }}</div>
                                            </div>
                                        @endif
                                        @if($responden->identitas2)
                                            <div class="p-2 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg border border-blue-100">
                                                <div class="text-xs text-blue-700 font-medium">
                                                    @if($form->identitas && $form->identitas->atribut2)
                                                        {{ $form->identitas->atribut2 }}
                                                    @else
                                                        Atribut 2
                                                    @endif
                                                </div>
                                                <div class="text-xs text-gray-900">{{ $responden->identitas2 }}</div>
                                            </div>
                                        @endif
                                        @if($responden->identitas3)
                                            <div class="p-2 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg border border-blue-100">
                                                <div class="text-xs text-blue-700 font-medium">
                                                    @if($form->identitas && $form->identitas->atribut3)
                                                        {{ $form->identitas->atribut3 }}
                                                    @else
                                                        Atribut 3
                                                    @endif
                                                </div>
                                                <div class="text-xs text-gray-900">{{ $responden->identitas3 }}</div>
                                            </div>
                                        @endif
                                        @if($responden->identitas4)
                                            <div class="p-2 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg border border-blue-100">
                                                <div class="text-xs text-blue-700 font-medium">
                                                    @if($form->identitas && $form->identitas->atribut4)
                                                        {{ $form->identitas->atribut4 }}
                                                    @else
                                                        Atribut 4
                                                    @endif
                                                </div>
                                                <div class="text-xs text-gray-900">{{ $responden->identitas4 }}</div>
                                            </div>
                                        @endif
                                        @if($responden->identitas5)
                                            <div class="p-2 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg border border-blue-100">
                                                <div class="text-xs text-blue-700 font-medium">
                                                    @if($form->identitas && $form->identitas->atribut5)
                                                        {{ $form->identitas->atribut5 }}
                                                    @else
                                                        Atribut 5
                                                    @endif
                                                </div>
                                                <div class="text-xs text-gray-900">{{ $responden->identitas5 }}</div>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Jawaban Responden -->
                                @if($responden->jawaban->count() > 0)
                                <div>
                                    <div class="flex items-center mb-2">
                                        <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <h4 class="text-sm font-medium text-gray-700">Jawaban:</h4>
                                    </div>
                                    @foreach($responden->jawaban as $jawaban)
                                        <div class="jawaban-item border-b border-gray-50 pb-2 hover:bg-gray-50 p-1 rounded">
                                            <div class="text-xs text-gray-900 truncate max-w-xs">{{ $jawaban->pertanyaan->teks }}</div>
                                            <div class="skala-indicator flex items-center">
                                                <div class="skala-dot skala-{{ $jawaban->jawaban }}" title="Skala {{ $jawaban->jawaban }}"></div>
                                                <span class="ml-2 text-xs font-medium skala-text-{{ $jawaban->jawaban }}">{{ $jawaban->jawaban }}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="bg-white rounded-2xl shadow-sm p-8 border border-gray-100 text-center">
                        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="text-gray-600 font-medium">Belum ada responden</p>
                        <p class="text-gray-500 text-sm mt-1">Data responden akan muncul setelah ada yang mengisi survey</p>
                    </div>
                @endif
            </div>

            <!-- Pertanyaan dan Statistik Section -->
            <div class="mb-8">
                <h2 class="text-base font-bold text-gray-900 mb-4">Statistik Jawaban</h2>

                @if(count($statistikPertanyaan) > 0)
                    @foreach($statistikPertanyaan as $index => $statistik)
                    <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 mb-6">
                        <h3 class="font-medium text-gray-900 mb-4">Pertanyaan {{ $index + 1 }}: {{ $statistik['pertanyaan'] }}</h3>

                        <!-- Enhanced statistics visualization -->
                        <div class="space-y-3">
                            @for($i = 1; $i <= 5; $i++)
                                @php
                                    $totalPertanyaanIni = array_sum($statistik['distribusi']);
                                    $percentage = $totalPertanyaanIni > 0 ? ($statistik['distribusi'][$i] / $totalPertanyaanIni) * 100 : 0;
                                @endphp
                                <div class="flex items-center">
                                    <div class="w-16 text-sm font-medium text-gray-700">Skala {{ $i }}</div>
                                    <div class="flex-1 ml-2">
                                        <div class="flex items-center">
                                            <div class="w-full bg-gray-200 rounded-full h-6 mr-2">
                                                <div
                                                    class="h-6 rounded-full skala-{{ $i }}"
                                                    style="width: {{ $percentage }}%; min-width: 20px;">
                                                    <div class="flex items-center justify-center h-full text-xs font-bold text-white">
                                                        {{ $statistik['distribusi'][$i] }}
                                                    </div>
                                                </div>
                                            </div>
                                            <span class="text-sm font-medium skala-text-{{ $i }}">{{ round($percentage) }}%</span>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>

                        <!-- Legend -->
                        <div class="mt-4 flex flex-wrap gap-3 text-xs">
                            <div class="flex items-center">
                                <div class="w-3 h-3 rounded-full skala-1 mr-1"></div>
                                <span class="text-gray-700">Sangat Tidak Setuju (1)</span>
                            </div>
                            <div class="flex items-center">
                                <div class="w-3 h-3 rounded-full skala-2 mr-1"></div>
                                <span class="text-gray-700">Tidak Setuju (2)</span>
                            </div>
                            <div class="flex items-center">
                                <div class="w-3 h-3 rounded-full skala-3 mr-1"></div>
                                <span class="text-gray-700">Netral (3)</span>
                            </div>
                            <div class="flex items-center">
                                <div class="w-3 h-3 rounded-full skala-4 mr-1"></div>
                                <span class="text-gray-700">Setuju (4)</span>
                            </div>
                            <div class="flex items-center">
                                <div class="w-3 h-3 rounded-full skala-5 mr-1"></div>
                                <span class="text-gray-700">Sangat Setuju (5)</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="bg-white rounded-2xl shadow-sm p-8 border border-gray-100 text-center">
                        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        <p class="text-gray-600 font-medium">Belum ada data statistik</p>
                        <p class="text-gray-500 text-sm mt-1">Statistik akan muncul setelah ada responden yang menjawab</p>
                    </div>
                @endif
            </div>
        </main>
    </div>

    <script>
        // Mobile Sidebar Toggle
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const sidebar = document.getElementById('sidebar');

        if (sidebarToggle && sidebar) {
            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('-translate-x-full');
                sidebar.classList.toggle('translate-x-0');

                const icon = this.querySelector('svg');
                if (sidebar.classList.contains('-translate-x-full')) {
                    icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>';
                } else {
                    icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>';
                }
            });

            document.addEventListener('click', function(event) {
                const isClickInsideSidebar = sidebar.contains(event.target);
                const isClickOnToggle = sidebarToggle.contains(event.target);

                if (!isClickInsideSidebar && !isClickOnToggle && window.innerWidth < 1024) {
                    sidebar.classList.add('-translate-x-full');
                    const icon = sidebarToggle.querySelector('svg');
                    icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>';
                }
            });
        }

        window.addEventListener('resize', function() {
            if (window.innerWidth >= 1024) {
                sidebar.classList.remove('-translate-x-full');
            } else {
                sidebar.classList.add('-translate-x-full');
            }
        });

        if (window.innerWidth < 1024) {
            sidebar.classList.add('-translate-x-full');
        }
    </script>

    <!-- No chart.js needed anymore, using custom visualization -->
    @fluxScripts
</body>
</html>