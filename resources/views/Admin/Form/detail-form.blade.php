<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPULAS - Detail Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'pastel-blue': '#E8F4FD',
                        'light-blue': '#B8E0FF',
                        'cream': '#FEF9E7',
                        'dark-blue': '#1E3A8A',
                        'medium-blue': '#3B82F6'
                    }
                }
            }
        }
    </script>
    <style>
        .sidebar-active {
            background: linear-gradient(135deg, #3B82F6 0%, #1E3A8A 100%);
            color: white;
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        }
        .cover-container {
            position: relative;
            background: linear-gradient(135deg, #E0E7FF 0%, #F3E8FF 100%);
            border-radius: 16px;
            overflow: hidden;
            height: 200px;
        }
        .cover-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: inherit;
            filter: blur(1.5px);
            border-radius: 16px;
        }
        .edit-fab {
            position: absolute;
            bottom: 16px;
            right: 16px;
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .edit-fab:hover {
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
            transform: scale(1.05);
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
            width: 40px;
            height: 40px;
            border-radius: 8px;
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
        <main class="flex-1 lg:ml-72 p-6 lg:p-8">
<!-- Header -->
<div class="mb-6">
    <div class="flex items-center space-x-2 mb-2">
        <a href="{{ route('forms.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Manajemen Form</a>
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
        <span class="text-sm text-gray-900 font-medium">{{ $form->nama }}</span>
    </div>
</div>

<!-- Cover Section -->
<div class="mb-8">
    <div class="relative">
        <div class="cover-container relative group">
            @if ($coverUrl)
                {{-- Gambar sampul di-dalam kotak, tidak menabrak navbar --}}
                <img src="{{ $coverUrl }}"
                     alt="Sampul {{ $form->nama }}"
                     class="absolute inset-0 w-full h-full object-cover" />
                {{-- lapisan halus supaya teks tetap kebaca --}}
                <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-black/10 to-transparent pointer-events-none"></div>
            @else
                {{-- Empty State Cover (tetap pakai rangka kamu) --}}
                <div class="w-full h-full flex items-center justify-center">
                    <div class="text-center">
                        <svg class="w-16 h-16 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <p class="text-sm text-gray-400">Sampul Form</p>
                    </div>
                </div>
            @endif

            <!-- Edit Button (biarin sesuai rangka kamu) -->
            <div class="edit-fab" title="Edit Identitas Form">
                <svg class="w-6 h-6 text-medium-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
            </div>
        </div>

        <!-- Title & Category Overlay (pakai data dinamis) -->
        <div class="absolute top-4 left-6 z-10 space-y-1">
            @if($form->kategori)
                <span class="inline-block text-[11px] font-medium text-white/95 bg-black/30 px-2 py-0.5 rounded">
                    {{ $form->kategori->nama }}
                </span>
            @endif
            <h2 class="text-lg font-bold text-white drop-shadow">
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
                <button class="px-5 py-2.5 bg-white border border-gray-200 text-gray-900 font-medium rounded-lg text-sm hover:bg-gray-50 transition-colors">
                    Lihat Responden
                </button>
                <button class="px-5 py-2.5 bg-white border border-gray-200 text-gray-900 font-medium rounded-lg text-sm hover:bg-gray-50 transition-colors">
                    Cetak Laporan
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
                        <div class="stat-value">0</div>
                        <div class="text-xs text-gray-500">Dari target 0</div>
                    </div>

                    <!-- Tingkat Respons -->
                    <div class="stat-card">
                        <div class="stat-icon" style="background-color: #DBEAFE;">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <div class="stat-label">Tingkat Respons</div>
                        <div class="stat-value">0%</div>
                        <div class="text-xs text-gray-500">Belum ada responden</div>
                    </div>

                    <!-- Rata-rata Waktu -->
                    <div class="stat-card">
                        <div class="stat-icon" style="background-color: #FEF3C7;">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="stat-label">Rata-rata Waktu</div>
                        <div class="stat-value">--</div>
                        <div class="text-xs text-gray-500">Menit pengisian</div>
                    </div>

                    <!-- Tingkat Penyelesaian -->
                    <div class="stat-card">
                        <div class="stat-icon" style="background-color: #DCFCE7;">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="stat-label">Penyelesaian</div>
                        <div class="stat-value">0%</div>
                        <div class="text-xs text-gray-500">Form terisi lengkap</div>
                    </div>
                </div>
            </div>

            <!-- Chart Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Grafik Responden -->
                <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                    <h3 class="text-sm font-bold text-gray-900 mb-4">Grafik Responden</h3>
                    <div class="empty-state">
                        <div class="empty-state-icon">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <p class="text-sm font-medium text-gray-600">Belum Ada Data</p>
                        <p class="text-xs text-gray-500 mt-1">Data akan muncul setelah responden mulai mengisi form</p>
                    </div>
                </div>

                <!-- Distribusi Responden -->
                <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                    <h3 class="text-sm font-bold text-gray-900 mb-4">Distribusi Responden</h3>
                    <div class="empty-state">
                        <div class="empty-state-icon">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                            </svg>
                        </div>
                        <p class="text-sm font-medium text-gray-600">Belum Ada Data</p>
                        <p class="text-xs text-gray-500 mt-1">Distribusi responden akan ditampilkan sesuai data yang masuk</p>
                    </div>
                </div>
            </div>

            <!-- Delete Form Section -->
            <div class="mt-8 pt-6 border-t border-gray-200">
                <button type="button" onclick="confirmDeleteForm({{ $form->id_kuesioner }})" class="w-full px-4 py-3 bg-red-600 text-white font-medium rounded-lg text-sm hover:bg-red-700 transition-colors text-center">
                    Hapus Form
                </button>
            </div>
        </main>
    </div>

    <script>
        // Edit button handler
        const editFab = document.querySelector('.edit-fab');
        editFab.addEventListener('click', function() {
            // Redirect to edit form page
            window.location.href = '{{ route('forms.edit', $form->id_kuesioner) }}';
        });

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
        
        // Delete form confirmation
        function confirmDeleteForm(formId) {
            if (confirm('Apakah Anda yakin ingin menghapus form ini? Tindakan ini tidak dapat dibatalkan dan semua data terkait akan dihapus.')) {
                // Create and submit a form to delete the form
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/form/${formId}`;
                form.style.display = 'none';
                
                // Add CSRF token using the value from the meta tag or directly from Laravel
                const tokenInput = document.createElement('input');
                tokenInput.type = 'hidden';
                tokenInput.name = '_token';
                tokenInput.value = '{{ csrf_token() }}'; // Directly embed the token from Laravel
                form.appendChild(tokenInput);
                
                // Add method spoofing for DELETE
                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';
                form.appendChild(methodInput);
                
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
</body>
</html>