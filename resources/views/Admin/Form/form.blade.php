<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPULAS - Manajemen Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-4px);
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
        <main class="flex-1 lg:ml-64">
            <!-- Top Header -->
            <header class="bg-white border-b border-gray-200 sticky top-0 z-30">
                <div class="px-6 lg:px-8 py-4">
                    <div class="flex justify-between items-center">
                        <div>
                            <h1 class="text-xl font-semibold text-gray-800">Manajemen Form</h1>
                            <p class="text-sm text-gray-500 mt-0.5">Kelola semua form survey dalam sistem</p>
                        </div>
                    </div>
                </div>
            </header>

            <div class="p-6 lg:p-8">
                <!-- Filter Section -->
                <div class="bg-white rounded-xl shadow-sm p-5 mb-6 border border-gray-100">
                    <form method="GET" action="{{ route('forms.index') }}" id="filter-form">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <!-- Search -->
                            <div class="md:col-span-1">
                                <label class="block text-xs font-semibold text-gray-700 mb-2">Cari Form</label>
                                <div class="relative">
                                    <input type="text"
                                           name="search"
                                           value="{{ request('search') }}"
                                           placeholder="Cari berdasarkan judul..."
                                           class="w-full px-4 py-2.5 pl-10 border border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-all duration-200 outline-none text-sm">
                                    <svg class="w-4 h-4 text-gray-400 absolute left-3.5 top-1/2 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                            </div>

                            <!-- Kategori Filter -->
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 mb-2">Kategori</label>
                                <select name="category"
                                        class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-all duration-200 outline-none bg-white text-sm">
                                    <option value="">Semua Kategori</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id_kategori }}" {{ request('category') == $category->id_kategori ? 'selected' : '' }}>
                                            {{ $category->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Status Filter -->
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 mb-2">Status</label>
                                <select name="status"
                                        class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-all duration-200 outline-none bg-white text-sm">
                                    <option value="">Semua Status</option>
                                    <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="nonaktif" {{ request('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="hidden"></button>
                    </form>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const filterForm = document.getElementById('filter-form');
                            const inputs = filterForm.querySelectorAll('select, input');

                            inputs.forEach(function(input) {
                                input.addEventListener('change', function() {
                                    filterForm.submit();
                                });
                            });
                        });
                    </script>

                    <!-- Button Buat Form -->
                    <div class="mt-5 pt-5 border-t border-gray-100">
                        <a href="{{ route('forms.create') }}" class="inline-flex items-center bg-gradient-to-r from-primary-500 to-primary-600 text-white px-5 py-2.5 rounded-lg font-medium text-sm hover:from-primary-600 hover:to-primary-700 transition-all duration-300 shadow-sm hover:shadow-md">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Buat Form Baru
                        </a>
                    </div>
                </div>

                <!-- Form Cards Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
                    @forelse ($forms as $form)
                        @php
                            $isActive = $form->is_active;
                            $statusText = $isActive ? 'Aktif' : 'Nonaktif';
                            $statusClass = $isActive ? 'bg-green-100 text-green-700 border-green-200' : 'bg-gray-100 text-gray-600 border-gray-200';

                            $kat = strtolower($form->kategori->nama ?? '-');
                            $badgeMap = [
                                'akademik' => ['text'=>'text-blue-600','bg'=>'bg-blue-50', 'border'=>'border-blue-200'],
                                'fasilitas'=> ['text'=>'text-orange-600','bg'=>'bg-orange-50', 'border'=>'border-orange-200'],
                                'layanan'  => ['text'=>'text-purple-600','bg'=>'bg-purple-50', 'border'=>'border-purple-200'],
                                'dosen'    => ['text'=>'text-emerald-600','bg'=>'bg-emerald-50', 'border'=>'border-emerald-200'],
                            ];
                            $c = $badgeMap[$kat] ?? ['text'=>'text-gray-700','bg'=>'bg-gray-100', 'border'=>'border-gray-200'];

                            $gradients = [
                                'akademik' => 'from-blue-50 to-indigo-50',
                                'fasilitas'=> 'from-orange-50 to-amber-50',
                                'layanan'  => 'from-purple-50 to-violet-50',
                                'dosen'    => 'from-emerald-50 to-teal-50',
                            ];
                            $grad = $gradients[$kat] ?? 'from-gray-50 to-slate-50';
                        @endphp

                        <div class="bg-white rounded-xl shadow-sm overflow-hidden card-hover border border-gray-100">
                            <!-- Header with gradient or cover -->
                            <div class="relative border-b border-gray-100">
                                @if($form->sampul)
                                    <img src="{{ asset('storage/'.$form->sampul) }}" alt="Sampul"
                                         class="w-full h-32 object-cover">
                                @else
                                    <div class="bg-gradient-to-br {{ $grad }} h-32 w-full"></div>
                                @endif
                                <span class="absolute top-3 right-3 {{ $statusClass }} text-xs font-semibold px-3 py-1 rounded-full shadow-sm border">
                                    {{ $statusText }}
                                </span>
                            </div>

                            <!-- Card Content -->
                            <div class="p-5">
                                <div class="mb-3">
                                    <span class="text-xs font-semibold {{ $c['text'] }} {{ $c['bg'] }} px-2.5 py-1 rounded-lg border {{ $c['border'] }}">
                                        {{ $form->kategori->nama ?? '-' }}
                                    </span>
                                </div>

                                <h3 class="text-base font-semibold text-gray-900 mb-3 line-clamp-2 min-h-[3rem]">{{ $form->nama }}</h3>

                                <div class="flex items-center space-x-2 text-gray-500 mb-4">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                    </svg>
                                    <span class="text-sm font-medium">{{ $form->respondens_count }} Responden</span>
                                </div>

                                <a href="{{ route('forms.show', $form->id_kuesioner) }}" class="w-full inline-flex items-center justify-center bg-primary-500 text-white py-2.5 px-4 rounded-lg font-medium hover:bg-primary-600 transition-all duration-200 text-sm">
                                    Kelola Form
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>

                                <div class="mt-3 text-xs text-gray-400 flex items-center justify-between">
                                    <span>Mulai: {{ $form->tanggal_mulai?->format('d/m/Y') ?? '-' }}</span>
                                    <span>Selesai: {{ $form->tanggal_selesai?->format('d/m/Y') ?? '-' }}</span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full bg-white rounded-xl p-12 text-center border border-gray-200 border-dashed">
                            <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                            <p class="text-gray-600 font-medium mb-2">Belum ada form</p>
                            <a href="{{ route('forms.create') }}" class="text-primary-600 font-semibold hover:text-primary-700">Buat Form Baru</a>
                        </div>
                    @endforelse
                </div>
            </div>
        </main>
    </div>

    <script>
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

    <style>
        #sidebar {
            transition: transform 0.3s ease;
        }

        @media (max-width: 1023px) {
            #sidebar {
                transform: translateX(-100%);
            }
            
            #sidebar.translate-x-0 {
                transform: translateX(0);
            }
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>

    <!-- Notification Toast -->
    <div id="notificationToast" class="fixed top-4 right-4 z-50 hidden">
        <div class="bg-green-500 text-white px-6 py-4 rounded-lg shadow-lg flex items-center space-x-3">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <span id="notificationMessage" class="font-medium"></span>
        </div>
    </div>

    <script>
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
    </script>
</body>
</html>