<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPULAS - Detail Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            300: '#93c5fd',
                            400: '#60a5fa',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }
        .cover-container {
            position: relative;
            background: linear-gradient(135deg, #E0E7FF 0%, #F3E8FF 100%);
            border-radius: 16px;
            overflow: hidden;
            height: 200px;
        }
        .stat-card {
            background: white;
            border: 1px solid #E5E7EB;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            transition: all 0.3s ease;
        }
        .stat-card:hover {
            border-color: #3B82F6;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.1);
        }
        .stat-value {
            font-size: 32px;
            font-weight: 700;
            color: #1E3A8A;
            margin: 8px 0;
        }
        .stat-label {
            font-size: 13px;
            color: #6B7280;
            font-weight: 500;
        }
        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 12px;
        }
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            background: #F9FAFB;
            border-radius: 12px;
            border: 2px dashed #E5E7EB;
        }
        .empty-state-icon {
            width: 60px;
            height: 60px;
            background: #E5E7EB;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="flex min-h-screen">
        @include('Admin.navbar')

        <!-- Main Content -->
        <main class="flex-1 lg:ml-64">
            <!-- Top Header -->
            <header class="bg-white border-b border-gray-200 sticky top-0 z-30">
                <div class="px-6 lg:px-8 py-4">
                    <div class="flex items-center space-x-2 text-sm text-gray-500 mb-2">
                        <a href="{{ route('forms.index') }}" class="hover:text-primary-600 transition-colors">Manajemen Form</a>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                        <span class="text-gray-900 font-medium">{{ $form->nama }}</span>
                    </div>
                </div>
            </header>

            <div class="p-6 lg:p-8">
                <!-- Cover Section -->
                <div class="mb-8">
                    <div class="relative">
                        <div class="cover-container relative group">
                            @if ($coverUrl)
                                <img src="{{ $coverUrl }}"
                                     alt="Sampul {{ $form->nama }}"
                                     class="absolute inset-0 w-full h-full object-cover" />
                                <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-black/10 to-transparent pointer-events-none"></div>
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <div class="text-center">
                                        <svg class="w-16 h-16 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <p class="text-sm text-gray-400">Sampul Form</p>
                                    </div>
                                </div>
                            @endif

                            <!-- Edit Button -->
                            <button onclick="window.location.href='{{ route('forms.edit', $form->id_kuesioner) }}'" class="absolute bottom-4 right-4 w-12 h-12 rounded-full bg-white shadow-lg flex items-center justify-center hover:scale-105 transition-transform z-10" title="Edit Identitas Form">
                                <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </button>
                        </div>

                        <!-- Title & Category Overlay -->
                        <div class="absolute top-4 left-6 z-10 space-y-1">
                            @if($form->kategori)
                                <span class="inline-block text-xs font-semibold text-white/95 bg-black/30 backdrop-blur px-3 py-1 rounded-full">
                                    {{ $form->kategori->nama }}
                                </span>
                            @endif
                            <h2 class="text-xl font-bold text-white drop-shadow-lg">
                                {{ $form->nama }}
                            </h2>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-wrap gap-3 mb-8 items-center">
                    <a href="{{ route('forms.edit-pertanyaan', $form->id_kuesioner) }}" class="px-5 py-2.5 bg-white border border-gray-200 text-gray-900 font-medium rounded-lg text-sm hover:bg-gray-50 transition-colors">
                        Edit Pertanyaan
                    </a>
                    <a href="{{ route('forms.responden', $form->id_kuesioner) }}" class="px-5 py-2.5 bg-white border border-gray-200 text-gray-900 font-medium rounded-lg text-sm hover:bg-gray-50 transition-colors">
                        Lihat Responden
                    </a>
                    <button onclick="openExportModal()" class="px-5 py-2.5 bg-white border border-gray-200 text-gray-900 font-medium rounded-lg text-sm hover:bg-gray-50 transition-colors">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                            </svg>
                            Cetak Laporan
                        </div>
                    </button>
                    <div class="ml-auto flex items-center gap-3">
                        <span id="statusLabel" class="text-sm font-medium text-gray-700">Aktif</span>
                        <button id="statusToggle" class="relative inline-flex h-8 w-14 items-center rounded-full bg-green-500 transition-colors cursor-pointer" title="Klik untuk mengubah status">
                            <span id="toggleDot" class="inline-block h-6 w-6 transform rounded-full bg-white transition-transform translate-x-7"></span>
                        </button>
                    </div>
                </div>

                <!-- Analytics Section -->
                <div class="mb-8">
                    <h2 class="text-base font-bold text-gray-900 mb-4">Analitik Form</h2>

                    <!-- Stats Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <!-- Total Responden -->
                        <div class="stat-card">
                            <div class="stat-icon" style="background-color: #F3E8FF;">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 10a3 3 0 11-6 0 3 3 0 016 0zM16 16a5 5 0 10-10 0 5 5 0 0010 0z"></path>
                                </svg>
                            </div>
                            <div class="stat-label">Total Responden</div>
                            <div class="stat-value">{{ $totalResponden }}</div>
                            <div class="text-xs text-gray-500">
                                @if($totalResponden == 0)
                                    Belum ada responden
                                @else
                                    Dari {{ $totalPertanyaan }} pertanyaan
                                @endif
                            </div>
                        </div>

                        <!-- Total Pertanyaan Terjawab -->
                        <div class="stat-card">
                            <div class="stat-icon" style="background-color: #DBEAFE;">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <div class="stat-label">Pertanyaan Terjawab</div>
                            <div class="stat-value">{{ $totalJawaban }}</div>
                            <div class="text-xs text-gray-500">
                                @if($totalJawaban == 0)
                                    Belum ada jawaban
                                @else
                                    Rata-rata {{ $totalResponden > 0 ? round($totalJawaban/$totalResponden, 1) : 0 }} jawaban/responden
                                @endif
                            </div>
                        </div>

                        <!-- Tingkat Penyelesaian -->
                        <div class="stat-card">
                            <div class="stat-icon" style="background-color: #FEF3C7;">
                                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                            <div class="stat-label">Tingkat Penyelesaian</div>
                            <div class="stat-value">{{ number_format($completionRate, 1) }}%</div>
                            <div class="text-xs text-gray-500">
                                @if($totalResponden == 0)
                                    Belum ada penyelesaian
                                @else
                                    Selesai {{ $totalResponden > 0 ? $totalJawaban/$totalResponden : 0 }} dari {{ $totalPertanyaan }}
                                @endif
                            </div>
                        </div>

                        <!-- Rata-rata Jawaban -->
                        <div class="stat-card">
                            <div class="stat-icon" style="background-color: #DCFCE7;">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div class="stat-label">Rata-rata Jawaban</div>
                            <div class="stat-value">
                                @if($rataRataJawaban > 0)
                                    {{ number_format($rataRataJawaban, 2) }}
                                @else
                                    --
                                @endif
                            </div>
                            <div class="text-xs text-gray-500">
                                @if($rataRataJawaban > 0)
                                    Skala 1-5
                                @else
                                    Tidak ada pertanyaan berskala
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Empty State if no respondents -->
                    @if($totalResponden == 0)
                    <div class="mt-6 bg-blue-50 border border-blue-100 rounded-lg p-6 text-center">
                        <svg class="w-12 h-12 text-blue-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <h3 class="text-lg font-medium text-blue-800 mb-1">Belum Ada Data Responden</h3>
                        <p class="text-blue-600">Statistik akan muncul setelah form mulai terisi.</p>
                    </div>
                    @endif
                </div>

                <!-- Chart Section -->
                @if($totalResponden > 0)
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                    <!-- Completion Rate Donut Chart -->
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                        <h3 class="text-sm font-bold text-gray-900 mb-4">Tingkat Penyelesaian Form</h3>
                        <div class="flex justify-center">
                            <div class="relative w-48 h-48">
                                <canvas id="completionChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Answers Distribution Bar Chart -->
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                        <h3 class="text-sm font-bold text-gray-900 mb-4">Distribusi Jawaban</h3>
                        <div class="h-48">
                            <canvas id="answersChart"></canvas>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Delete Form Section -->
                <div class="bg-white rounded-xl shadow-sm p-6 border border-red-100">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-base font-semibold text-gray-900 mb-1">Zona Berbahaya</h3>
                            <p class="text-sm text-gray-600 mb-4">Tindakan ini tidak dapat dibatalkan. Form dan semua data terkait akan dihapus permanen.</p>
                            <button type="button" onclick="confirmDeleteForm({{ $form->id_kuesioner }})" class="px-5 py-2.5 bg-red-600 text-white font-medium rounded-lg text-sm hover:bg-red-700 transition-colors">
                                Hapus Form
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Status toggle handler
        const statusToggle = document.getElementById('statusToggle');
        const statusLabel = document.getElementById('statusLabel');
        const toggleDot = document.getElementById('toggleDot');
        let isActive = true;

        statusToggle.addEventListener('click', function() {
            isActive = !isActive;
            
            if (isActive) {
                statusLabel.textContent = 'Aktif';
                statusToggle.classList.remove('bg-gray-400');
                statusToggle.classList.add('bg-green-500');
                toggleDot.classList.remove('translate-x-1');
                toggleDot.classList.add('translate-x-7');
            } else {
                statusLabel.textContent = 'Nonaktif';
                statusToggle.classList.remove('bg-green-500');
                statusToggle.classList.add('bg-gray-400');
                toggleDot.classList.remove('translate-x-7');
                toggleDot.classList.add('translate-x-1');
            }
        });
    </script>

    <!-- Notification Toast -->
    <div id="notificationToast" class="fixed top-4 right-4 z-50 hidden">
        <div class="bg-green-500 text-white px-6 py-4 rounded-lg shadow-lg flex items-center space-x-3">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <span id="notificationMessage" class="font-medium"></span>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Konfirmasi Penghapusan
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500" id="deleteModalMessage">
                                    Apakah Anda yakin ingin menghapus form <span id="deleteItemName" class="font-semibold"></span>? Tindakan ini tidak dapat dibatalkan dan semua data terkait akan dihapus.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <form id="deleteForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Hapus
                        </button>
                    </form>
                    <button type="button" onclick="closeDeleteModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let deleteItemId = null;

        function showDeleteConfirmation(formId, formName) {
            deleteItemId = formId;
            document.getElementById('deleteItemName').textContent = formName;
            document.getElementById('deleteForm').action = '/form/' + formId;
            document.getElementById('deleteModal').classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
            deleteItemId = null;
        }

        function showNotification(message) {
            const toast = document.getElementById('notificationToast');
            const messageElement = document.getElementById('notificationMessage');

            messageElement.textContent = message;
            toast.classList.remove('hidden');

            setTimeout(() => {
                toast.classList.add('hidden');
            }, 3000);
        }

        @if(session('success'))
            showNotification('{{ session('success') }}');
        @endif

        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDeleteModal();
            }
        });

        document.getElementById('deleteForm').addEventListener('submit', function() {
            setTimeout(() => {
                showNotification('Form berhasil dihapus');
            }, 300);
        });

        function confirmDeleteForm(formId) {
            showDeleteConfirmation(formId, '{{ addslashes($form->nama) }}');
        }

        // Export modal functions
        function openExportModal() {
            document.getElementById('exportModal').classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closeExportModal() {
            document.getElementById('exportModal').classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        function exportReport(format) {
            // Close modal and redirect to export route
            closeExportModal();
            window.location.href = `/form/{{ $form->id_kuesioner }}/export.${format}`;
        }

        // Initialize charts if there's data
        @if($totalResponden > 0)
        document.addEventListener('DOMContentLoaded', function() {
            // Completion Rate Donut Chart
            const completionCtx = document.getElementById('completionChart').getContext('2d');
            const completionChart = new Chart(completionCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Tingkat Penyelesaian', 'Belum Selesai'],
                    datasets: [{
                        data: [{{ $completionRate }}, {{ 100 - $completionRate }}],
                        backgroundColor: [
                            '#10B981',   // green - completed
                            '#E5E7EB'    // gray - not completed
                        ],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return context.label + ': ' + context.parsed + '%';
                                }
                            }
                        }
                    }
                }
            });

            // Answers Distribution Bar Chart - using PHP calculated data
            const answersCtx = document.getElementById('answersChart').getContext('2d');
            new Chart(answersCtx, {
                type: 'bar',
                data: {
                    labels: ['Skor 1', 'Skor 2', 'Skor 3', 'Skor 4', 'Skor 5'],
                    datasets: [{
                        label: 'Jumlah Jawaban',
                        data: [0, 0, 0, 0, 0], // Placeholder - would be replaced with actual distribution
                        backgroundColor: '#3B82F6',
                        borderColor: '#2563EB',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });
        });
        @endif
    </script>

    <!-- Export Modal -->
    <div id="exportModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M11 19l-4-4m0 0l-4 4m4-4v14" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                Ekspor Laporan
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500 mb-4">
                                    Pilih format file yang ingin Anda ekspor untuk laporan form "{{ $form->nama }}".
                                </p>
                                <div class="grid grid-cols-2 gap-3">
                                    <button onclick="exportReport('pdf')" class="flex flex-col items-center justify-center p-4 border border-gray-200 rounded-lg hover:border-blue-500 hover:bg-blue-50 transition-colors">
                                        <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center mb-2">
                                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                        <span class="text-sm font-medium text-gray-900">PDF</span>
                                        <span class="text-xs text-gray-500">Dokumen profesional</span>
                                    </button>
                                    <button onclick="exportReport('xlsx')" class="flex flex-col items-center justify-center p-4 border border-gray-200 rounded-lg hover:border-green-500 hover:bg-green-50 transition-colors">
                                        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mb-2">
                                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"></path>
                                            </svg>
                                        </div>
                                        <span class="text-sm font-medium text-gray-900">Excel</span>
                                        <span class="text-xs text-gray-500">Data terstruktur</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" onclick="closeExportModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>