<!DOCTYPE html>
<html lang="id">
<head>
    @include('partials.head')
    <title>SIPULAS - Dashboard</title>
    <style>
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }
        .stat-card {
            transition: all 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-2px);
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
            <!-- Top Header Bar -->
            <header class="bg-white border-b border-gray-200 sticky top-0 z-30">
                <div class="px-6 lg:px-8 py-4">
                    <div class="flex justify-between items-center">
                        <div>
                            <h1 class="text-xl font-semibold text-gray-800">Dashboard</h1>
                            @php
                                $currentUser = Auth::user();
                            @endphp
                            @if($currentUser && isset($currentUser->nama))
                                <p class="text-sm text-gray-500 mt-0.5">Selamat datang kembali, {{ $currentUser->nama }}!</p>
                            @else
                                <p class="text-sm text-gray-500 mt-0.5">Selamat datang kembali!</p>
                            @endif
                        </div>

                        <!-- Profile Section -->
                        @if($currentUser && isset($currentUser->nama) && isset($currentUser->id_admin))
                        <a href="{{ route('admin.profil') }}" class="flex items-center space-x-3 hover:bg-gray-50 rounded-lg px-3 py-2 transition-colors">
                            <div class="text-right hidden sm:block">
                                <p class="text-sm font-medium text-gray-700">{{ $currentUser->nama }}</p>
                                <p class="text-xs text-gray-400">Administrator</p>
                            </div>
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-primary-500 to-primary-600 flex items-center justify-center text-white font-semibold text-sm shadow-sm">
                                {{ strtoupper(substr($currentUser->nama, 0, 1)) }}
                            </div>
                        </a>
                        @else
                        <div class="flex items-center space-x-3">
                            <div class="text-right hidden sm:block">
                                <p class="text-sm font-medium text-gray-700">Administrator</p>
                                <p class="text-xs text-gray-400">Admin</p>
                            </div>
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-primary-500 to-primary-600 flex items-center justify-center text-white font-semibold text-sm shadow-sm">
                                A
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <div class="p-6 lg:p-8">
                <!-- Stats Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
                    <!-- Jumlah Form -->
                    <div class="stat-card bg-white rounded-xl p-5 border border-gray-100 shadow-sm">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Total Form</p>
                                <p class="text-2xl font-bold text-gray-800 mt-1">{{ \App\Models\Kuesioner::count() }}</p>
                                <p class="text-xs text-gray-400 mt-1">Form survey aktif</p>
                            </div>
                            <div class="w-12 h-12 bg-gradient-to-br from-primary-100 to-primary-200 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Jumlah Partisipan -->
                    <div class="stat-card bg-white rounded-xl p-5 border border-gray-100 shadow-sm">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Total Responden</p>
                                <p class="text-2xl font-bold text-gray-800 mt-1">{{ \App\Models\Responden::count() }}</p>
                                <p class="text-xs text-gray-400 mt-1">Partisipan keseluruhan</p>
                            </div>
                            <div class="w-12 h-12 bg-gradient-to-br from-green-100 to-green-200 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 10a3 3 0 11-6 0 3 3 0 016 0zM16 16a5 5 0 10-10 0 5 5 0 0010 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Jumlah Kategori -->
                    <div class="stat-card bg-white rounded-xl p-5 border border-gray-100 shadow-sm">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Total Kategori</p>
                                <p class="text-2xl font-bold text-gray-800 mt-1">{{ \App\Models\Kategori::count() }}</p>
                                <p class="text-xs text-gray-400 mt-1">Kategori tersedia</p>
                            </div>
                            <div class="w-12 h-12 bg-gradient-to-br from-accent-100 to-accent-200 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-accent-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Jumlah Admin -->
                    <div class="stat-card bg-white rounded-xl p-5 border border-gray-100 shadow-sm">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Total Admin</p>
                                <p class="text-2xl font-bold text-gray-800 mt-1">{{ \App\Models\Admin::count() }}</p>
                                <p class="text-xs text-gray-400 mt-1">Administrator aktif</p>
                            </div>
                            <div class="w-12 h-12 bg-gradient-to-br from-purple-100 to-purple-200 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Quick Actions -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-xl border border-gray-100 shadow-sm">
                            <div class="px-5 py-4 border-b border-gray-100">
                                <h3 class="text-base font-semibold text-gray-800">Aksi Cepat</h3>
                                <p class="text-xs text-gray-400 mt-0.5">Pintasan menu utama</p>
                            </div>
                            <div class="p-4 space-y-3">
                                <a href="{{ route('forms.create') }}" class="flex items-center p-3 bg-gradient-to-r from-primary-500 to-primary-600 text-white rounded-lg hover:from-primary-600 hover:to-primary-700 transition-all duration-200 group">
                                    <div class="w-9 h-9 bg-white/20 rounded-lg flex items-center justify-center mr-3">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <span class="font-medium text-sm">Buat Form Baru</span>
                                        <p class="text-xs text-white/70">Tambah survey baru</p>
                                    </div>
                                </a>
                                
                                <a href="{{ route('kategori.tambah') }}" class="flex items-center p-3 bg-gradient-to-r from-accent-400 to-accent-500 text-white rounded-lg hover:from-accent-500 hover:to-accent-600 transition-all duration-200 group">
                                    <div class="w-9 h-9 bg-white/20 rounded-lg flex items-center justify-center mr-3">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <span class="font-medium text-sm">Tambah Kategori</span>
                                        <p class="text-xs text-white/70">Kategori survey baru</p>
                                    </div>
                                </a>
                                
                                <a href="{{ route('admin.create') }}" class="flex items-center p-3 bg-gradient-to-r from-gray-600 to-gray-700 text-white rounded-lg hover:from-gray-700 hover:to-gray-800 transition-all duration-200 group">
                                    <div class="w-9 h-9 bg-white/20 rounded-lg flex items-center justify-center mr-3">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <span class="font-medium text-sm">Tambah Admin</span>
                                        <p class="text-xs text-white/70">Administrator baru</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Forms Table -->
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-xl border border-gray-100 shadow-sm">
                            <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
                                <div>
                                    <h3 class="text-base font-semibold text-gray-800">Form Terbaru</h3>
                                    <p class="text-xs text-gray-400 mt-0.5">5 form survey terakhir</p>
                                </div>
                                <a href="{{ route('forms.index') }}" class="text-sm text-primary-600 hover:text-primary-700 font-medium flex items-center">
                                    Lihat Semua
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="w-full">
                                    <thead>
                                        <tr class="bg-gray-50/50">
                                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Nama Form</th>
                                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Kategori</th>
                                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Responden</th>
                                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100">
                                        @forelse(\App\Models\Kuesioner::with('kategori')->latest()->take(5)->get() as $form)
                                        <tr class="hover:bg-gray-50/50 transition-colors">
                                            <td class="px-5 py-4">
                                                <p class="text-sm font-medium text-gray-800 truncate max-w-[200px]" title="{{ $form->nama }}">{{ $form->nama }}</p>
                                            </td>
                                            <td class="px-5 py-4">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary-50 text-primary-700">
                                                    {{ $form->kategori ? $form->kategori->nama : '-' }}
                                                </span>
                                            </td>
                                            <td class="px-5 py-4">
                                                <p class="text-sm text-gray-600">{{ $form->respondens->count() }} orang</p>
                                            </td>
                                            <td class="px-5 py-4">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $form->is_active ? 'bg-green-50 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                                    <span class="w-1.5 h-1.5 rounded-full mr-1.5 {{ $form->is_active ? 'bg-green-500' : 'bg-gray-400' }}"></span>
                                                    {{ $form->is_active ? 'Aktif' : 'Nonaktif' }}
                                                </span>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4" class="px-5 py-12 text-center">
                                                <div class="flex flex-col items-center">
                                                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-3">
                                                        <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                                        </svg>
                                                    </div>
                                                    <p class="text-sm text-gray-500">Belum ada form tersedia</p>
                                                    <a href="{{ route('forms.create') }}" class="mt-2 text-sm text-primary-600 hover:text-primary-700 font-medium">
                                                        Buat Form Pertama
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
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
    @fluxScripts
</body>
</html>