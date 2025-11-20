<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPULAS - Dashboard</title>
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
        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.08);
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="flex min-h-screen">
        @include('Admin.navbar')

        <!-- Mobile Sidebar Toggle -->
        <button class="fixed top-6 right-6 z-50 lg:hidden bg-white p-3 rounded-xl shadow-lg border border-gray-200" id="sidebar-toggle">
            <svg class="w-5 h-5 text-dark-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>

        <!-- Main Content -->
        <main class="flex-1 lg:ml-72 p-6 lg:p-8 lg:pr-6">
            <!-- Header and Profile Info Row -->
            <div class="flex justify-between items-start mb-6">
                <!-- Header -->
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 mb-1">Dashboard</h1>
                    @php
                        $currentUser = Auth::user();
                    @endphp
                    @if($currentUser && isset($currentUser->nama))
                        <p class="text-sm text-gray-600">Selamat Datang, {{ $currentUser->nama }}!</p>
                    @else
                        <p class="text-sm text-gray-600">Selamat Datang!</p>
                    @endif
                </div>

                <!-- Profile Icon and Name -->
                @if($currentUser && isset($currentUser->nama) && isset($currentUser->id_admin))
                <a href="{{ route('admin.profil') }}" class="flex items-center space-x-3">
                    <span class="text-sm font-medium text-gray-700 hidden md:block">{{ $currentUser->nama }}</span>
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-medium-blue to-blue-600 flex items-center justify-center text-white font-semibold text-sm">
                        {{ strtoupper(substr($currentUser->nama, 0, 1)) }}
                    </div>
                </a>
                @else
                <div class="flex items-center space-x-3">
                    <span class="text-sm font-medium text-gray-700 hidden md:block">Administrator</span>
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-medium-blue to-blue-600 flex items-center justify-center text-white font-semibold text-sm">
                        A
                    </div>
                </div>
                @endif
            </div>

            <!-- Statistik Cards Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 mb-6">
                <!-- Jumlah Form (Large Card) -->
                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl shadow-sm p-6 border border-blue-100 lg:col-span-2">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-sm font-semibold text-blue-800 mb-1">Jumlah Form</h3>
                            <p class="text-4xl font-bold text-blue-900">{{ \App\Models\Kuesioner::count() }}</p>
                        </div>
                        <div class="w-14 h-14 bg-blue-500 rounded-xl flex items-center justify-center shadow-md">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Jumlah Partisipan Keseluruhan (Large Card) -->
                <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl shadow-sm p-6 border border-green-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-sm font-semibold text-green-800 mb-1">Jumlah Partisipan</h3>
                            <p class="text-4xl font-bold text-green-900">{{ \App\Models\Responden::count() }}</p>
                        </div>
                        <div class="w-14 h-14 bg-green-500 rounded-xl flex items-center justify-center shadow-md">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 10a3 3 0 11-6 0 3 3 0 016 0zM16 16a5 5 0 10-10 0 5 5 0 0010 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Small Statistik Cards and Content Row -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
                <!-- Left Column: Aksi Cepat and Small Stats -->
                <div class="space-y-5">
                    <!-- Jumlah Kategori (Small Card) -->
                    <div class="bg-gradient-to-br from-purple-50 to-violet-50 rounded-2xl shadow-sm p-5 border border-purple-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-semibold text-purple-800 mb-1">Jumlah Kategori</h3>
                                <p class="text-2xl font-bold text-purple-900">{{ \App\Models\Kategori::count() }}</p>
                            </div>
                            <div class="w-12 h-12 bg-purple-500 rounded-xl flex items-center justify-center shadow-md">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Jumlah Admin (Small Card) -->
                    <div class="bg-gradient-to-br from-red-50 to-rose-50 rounded-2xl shadow-sm p-5 border border-red-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-semibold text-red-800 mb-1">Jumlah Admin</h3>
                                <p class="text-2xl font-bold text-red-900">{{ \App\Models\Admin::count() }}</p>
                            </div>
                            <div class="w-12 h-12 bg-red-500 rounded-xl flex items-center justify-center shadow-md">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Aksi Cepat -->
                    <div class="bg-white rounded-2xl shadow-sm p-5 border border-gray-100">
                        <h3 class="text-base font-semibold text-gray-900 mb-4">Aksi Cepat</h3>
                        <div class="space-y-3">
                            <a href="{{ route('forms.create') }}" class="flex items-center p-4 bg-gradient-to-r from-medium-blue to-blue-600 text-white rounded-xl hover:from-dark-blue hover:to-blue-700 transition-all duration-200 shadow-sm hover:shadow-md">
                                <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                <span class="font-medium">Buat Form Baru</span>
                            </a>
                            <a href="{{ route('kategori.tambah') }}" class="flex items-center p-4 bg-gradient-to-r from-medium-blue to-blue-600 text-white rounded-xl hover:from-dark-blue hover:to-blue-700 transition-all duration-200 shadow-sm hover:shadow-md">
                                <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                                <span class="font-medium">Tambah Kategori</span>
                            </a>
                            <a href="{{ route('admin.create') }}" class="flex items-center p-4 bg-gradient-to-r from-medium-blue to-blue-600 text-white rounded-xl hover:from-dark-blue hover:to-blue-700 transition-all duration-200 shadow-sm hover:shadow-md">
                                <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                                <span class="font-medium">Tambah Admin</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Rangkuman Form -->
                <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-5 border-b border-gray-100">
                        <h3 class="text-base font-semibold text-gray-900">Rangkuman Form Terbaru</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Nama Form</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Kategori</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Responden</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse(\App\Models\Kuesioner::with('kategori')->latest()->take(5)->get() as $form)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900 max-w-xs truncate" title="{{ $form->nama }}">{{ $form->nama }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">{{ $form->kategori ? $form->kategori->nama : '-' }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">{{ $form->respondens->count() }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                            {{ $form->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                            {{ $form->is_active ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-8 text-center text-sm text-gray-500">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                            </svg>
                                            <p>Belum ada form tersedia</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="p-4 bg-gray-50 border-t border-gray-100">
                        <a href="{{ route('forms.index') }}" class="text-sm text-medium-blue font-medium hover:underline flex items-center justify-end">
                            Lihat Semua Form
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
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

                // Change icon
                const icon = this.querySelector('svg');
                if (sidebar.classList.contains('-translate-x-full')) {
                    icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>';
                } else {
                    icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>';
                }
            });

            // Close sidebar when clicking outside on mobile
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

        // Responsive sidebar initialization
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 1024) {
                sidebar.classList.remove('-translate-x-full');
            } else {
                sidebar.classList.add('-translate-x-full');
            }
        });

        // Initialize sidebar state
        if (window.innerWidth < 1024) {
            sidebar.classList.add('-translate-x-full');
        }
    </script>

    <style>
        /* Smooth transitions for sidebar */
        #sidebar {
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @media (max-width: 1023px) {
            #sidebar {
                transform: translateX(-100%);
                left: 1rem;
                width: calc(100% - 2rem);
                max-width: 280px;
            }

            #sidebar.translate-x-0 {
                transform: translateX(0);
            }
        }

        /* Line clamp for text truncation */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: #3B82F6;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #1E3A8A;
        }

        /* Smooth card transitions */
        .card-hover {
            will-change: transform, box-shadow;
        }

        /* Better focus states for accessibility */
        button:focus-visible,
        input:focus-visible,
        select:focus-visible {
            outline: 2px solid #3B82F6;
            outline-offset: 2px;
        }
    </style>
</body>
</html>