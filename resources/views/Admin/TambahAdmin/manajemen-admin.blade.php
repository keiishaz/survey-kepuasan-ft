<!DOCTYPE html>
<html lang="id">
<head>
    @include('partials.head')
    <title>SIPULAS - Manajemen Admin</title>
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
            <!-- Header -->
            <div class="mb-6">
                <h1 class="text-xl font-bold text-gray-900 mb-1">Manajemen Admin</h1>
                <p class="text-xs text-gray-600">Kelola semua akun admin dalam sistem</p>
            </div>

            <!-- Success Message -->
            @if(session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Filter Section -->
            <div class="bg-white rounded-2xl shadow-sm p-4 mb-6 border border-gray-100">
                <div class="flex flex-col sm:flex-row gap-3 items-start sm:items-end">
                    <!-- Search -->
                    <div class="flex-1 w-full">
                        <label class="block text-xs font-semibold text-gray-700 mb-1.5">Cari Admin</label>
                        <div class="relative">
                            <input type="text"
                                   placeholder="Cari..."
                                   class="w-full px-3 py-2 pl-9 border border-gray-200 rounded-xl focus:border-medium-blue focus:ring-2 focus:ring-medium-blue/20 transition-all duration-200 outline-none text-sm text-gray-900">
                            <svg class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Button Tambah -->
                    <button class="bg-gradient-to-r from-medium-blue to-blue-600 text-white px-4 py-2 rounded-xl font-medium text-sm hover:from-dark-blue hover:to-blue-700 transition-all duration-300 shadow-sm hover:shadow-md flex items-center space-x-1.5 whitespace-nowrap">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        <a href="{{ url('/admin/tambah') }}" class="...">Tambah</a>
                    </button>
                </div>
            </div>

            <!-- Admin List -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <!-- Mobile card view for smaller screens -->
                <div class="block sm:hidden">
                    @forelse($admins as $admin)
                    <div class="p-4 border-b border-gray-100 last:border-b-0">
                        <div class="flex justify-between items-start">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gradient-to-br from-medium-blue to-blue-600 flex items-center justify-center text-white font-semibold">
                                    {{ strtoupper(substr($admin->nama, 0, 1)) }}
                                </div>
                                <div class="ml-3">
                                    <div class="text-sm font-medium text-gray-900">{{ $admin->nama }}</div>
                                    <div class="text-xs text-gray-500 mt-1">{{ $admin->email }}</div>
                                    <div class="text-xs text-gray-400 mt-1">Password: ••••••••</div>
                                </div>
                            </div>
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.edit', $admin->id_admin) }}" class="text-blue-600 hover:text-blue-900 p-1">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>
                                <button type="button" data-delete-url="{{ route('admin.destroy', $admin->id_admin) }}" data-item-name="{{ addslashes($admin->nama) }}" data-item-id="{{ $admin->id_admin }}" class="text-red-600 hover:text-red-900 p-1 data-delete-btn">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="p-6 text-center text-sm text-gray-500">
                        Belum ada admin. <a href="{{ route('admin.create') }}" class="text-medium-blue font-semibold hover:underline">Tambah Admin</a>
                    </div>
                    @endforelse
                </div>

                <!-- Desktop table view -->
                <div class="hidden sm:block overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Nama Admin</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Email</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Password</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($admins as $admin)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div class="h-10 w-10 rounded-full bg-gradient-to-br from-medium-blue to-blue-600 flex items-center justify-center text-white font-semibold">
                                                {{ strtoupper(substr($admin->nama, 0, 1)) }}
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $admin->nama }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                    {{ $admin->email }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                    <span class="text-gray-400">••••••••</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end space-x-2">
                                        <a href="{{ route('admin.edit', $admin->id_admin) }}" class="text-blue-600 hover:text-blue-900">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>
                                        <button type="button" data-delete-url="{{ route('admin.destroy', $admin->id_admin) }}" data-item-name="{{ addslashes($admin->nama) }}" data-item-id="{{ $admin->id_admin }}" class="text-red-600 hover:text-red-900 data-delete-btn">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">
                                    Belum ada admin. <a href="{{ route('admin.create') }}" class="text-medium-blue font-semibold hover:underline">Tambah Admin</a>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
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

    <!-- Notification Toast -->
    <div id="notificationToast" class="fixed top-4 right-4 z-50 hidden">
        <div class="bg-green-500 text-white px-6 py-4 rounded-lg shadow-lg flex items-center space-x-3">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <span id="notificationMessage" class="font-medium"></span>
        </div>
    </div>

    @include('partials.confirmation-modal')
    @fluxScripts
</body>
</html>