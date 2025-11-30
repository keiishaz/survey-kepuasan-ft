<!DOCTYPE html>
<html lang="id">
<head>
    @include('partials.head')
    <title>SIPULAS - Tambah Admin</title>
    <style>
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
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
                            <h1 class="text-xl font-semibold text-gray-800">Tambah Admin</h1>
                            <p class="text-sm text-gray-500 mt-0.5">Form tambah akun admin baru</p>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <div class="p-6 lg:p-8">

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form Container -->
            <div class="bg-white rounded-2xl shadow-sm p-6 lg:p-8 border border-gray-100">
                <form action="{{ route('admin.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nama Admin -->
                        <div class="md:col-span-2">
                            <label for="nama" class="block text-sm font-semibold text-gray-700 mb-2">Nama Admin</label>
                            <input type="text"
                                   id="nama"
                                   name="nama"
                                   value="{{ old('nama') }}"
                                   required
                                   placeholder="Masukkan nama lengkap admin"
                                   class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:border-medium-blue focus:ring-2 focus:ring-medium-blue/20 transition-all duration-200 outline-none text-sm text-gray-900 bg-white">
                            @error('nama')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="md:col-span-2">
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                            <input type="email"
                                   id="email"
                                   name="email"
                                   value="{{ old('email') }}"
                                   required
                                   placeholder="Masukkan alamat email admin"
                                   class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:border-medium-blue focus:ring-2 focus:ring-medium-blue/20 transition-all duration-200 outline-none text-sm text-gray-900 bg-white">
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                            <div class="relative">
                                <input type="password"
                                       id="password"
                                       name="password"
                                       required
                                       placeholder="Masukkan password"
                                       class="w-full px-4 py-2.5 pr-10 border border-gray-200 rounded-xl focus:border-medium-blue focus:ring-2 focus:ring-medium-blue/20 transition-all duration-200 outline-none text-sm text-gray-900 bg-white">
                                <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center" onclick="togglePassword('password')">
                                    <svg id="password-eye-open" class="w-5 h-5 text-gray-400 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    <svg id="password-eye-closed" class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                                    </svg>
                                </button>
                            </div>
                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">Konfirmasi Password</label>
                            <div class="relative">
                                <input type="password"
                                       id="password_confirmation"
                                       name="password_confirmation"
                                       required
                                       placeholder="Ulangi password"
                                       class="w-full px-4 py-2.5 pr-10 border border-gray-200 rounded-xl focus:border-medium-blue focus:ring-2 focus:ring-medium-blue/20 transition-all duration-200 outline-none text-sm text-gray-900 bg-white">
                                <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center" onclick="togglePassword('password_confirmation')">
                                    <svg id="password_confirmation-eye-open" class="w-5 h-5 text-gray-400 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    <svg id="password_confirmation-eye-closed" class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Submit and Cancel Buttons -->
                    <div class="mt-8 flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4">
                        <button type="submit" 
                                class="flex-1 bg-gradient-to-r from-medium-blue to-blue-600 text-white px-5 py-3 rounded-xl font-medium text-sm hover:from-dark-blue hover:to-blue-700 transition-all duration-300 shadow-sm hover:shadow-md">
                            Simpan Admin
                        </button>
                        <a href="{{ route('admin.index') }}" 
                           class="flex-1 bg-gray-100 text-gray-700 px-5 py-3 rounded-xl font-medium text-sm hover:bg-gray-200 transition-all duration-200 text-center">
                            Batal
                        </a>
                    </div>
                </form>
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

        // Toggle password visibility
        function togglePassword(inputId) {
            const passwordInput = document.getElementById(inputId);
            const eyeOpen = document.getElementById(inputId + '-eye-open');
            const eyeClosed = document.getElementById(inputId + '-eye-closed');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                if (eyeOpen) eyeOpen.classList.remove('hidden');
                if (eyeClosed) eyeClosed.classList.add('hidden');
            } else {
                passwordInput.type = 'password';
                if (eyeOpen) eyeOpen.classList.add('hidden');
                if (eyeClosed) eyeClosed.classList.remove('hidden');
            }
        }
    </script>

    <script>
        // Initialize password visibility icons
        document.addEventListener('DOMContentLoaded', function() {
            // Set initial state - password fields start as hidden (show closed eye icon)
            document.getElementById('password-eye-open')?.classList.add('hidden');
            document.getElementById('password-eye-closed')?.classList.remove('hidden');
            document.getElementById('password_confirmation-eye-open')?.classList.add('hidden');
            document.getElementById('password_confirmation-eye-closed')?.classList.remove('hidden');
        });
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
            background: #f1f5f9;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Better focus states for accessibility */
        button:focus-visible,
        input:focus-visible,
        select:focus-visible {
            outline: 2px solid #3B82F6;
            outline-offset: 2px;
        }
    </style>

    @include('partials.confirmation-modal')
    @fluxScripts
</body>
</html>