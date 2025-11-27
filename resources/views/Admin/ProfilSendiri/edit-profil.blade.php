<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPULAS - Edit Profil Sendiri</title>
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
            <!-- Header -->
            <div class="mb-6 lg:mt-0 mt-16">
                <h1 class="text-xl font-bold text-gray-900 mb-1">Edit Profil Sendiri</h1>
                <p class="text-xs text-gray-600">Ubah informasi profil dan password Anda</p>
            </div>

            <!-- Success/Failure Messages -->
            @if (session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl">
                    {{ session('success') }}
                </div>
            @endif

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
            <div class="space-y-6 max-w-7xl">
                <!-- Form Edit Profil -->
                <div class="bg-white rounded-2xl shadow-sm p-6 lg:p-8 border border-gray-100">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Edit Profil</h2>
                    <form action="{{ route('admin.update.profil') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nama Admin -->
                            <div class="md:col-span-2">
                                <label for="nama" class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                                <input type="text"
                                       id="nama"
                                       name="nama"
                                       value="{{ old('nama', $admin->nama) }}"
                                       required
                                       placeholder="Masukkan nama lengkap Anda"
                                       class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:border-medium-blue focus:ring-2 focus:ring-medium-blue/20 transition-all duration-200 outline-none text-sm">
                                @error('nama')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="md:col-span-2">
                                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Alamat Email</label>
                                <input type="email"
                                       id="email"
                                       name="email"
                                       value="{{ old('email', $admin->email) }}"
                                       required
                                       placeholder="Masukkan alamat email Anda"
                                       class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:border-medium-blue focus:ring-2 focus:ring-medium-blue/20 transition-all duration-200 outline-none text-sm">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-8">
                            <button type="submit"
                                    class="w-full bg-gradient-to-r from-medium-blue to-blue-600 text-white px-5 py-3 rounded-xl font-medium text-sm hover:from-dark-blue hover:to-blue-700 transition-all duration-300 shadow-sm hover:shadow-md">
                                Perbarui Profil
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Form Ganti Password -->
                <div class="bg-white rounded-2xl shadow-sm p-6 lg:p-8 border border-gray-100">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Ubah Password</h2>
                    <form action="{{ route('admin.update.password') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Password Lama -->
                            <div>
                                <label for="current_password" class="block text-sm font-semibold text-gray-700 mb-2">Password Lama</label>
                                <div class="relative">
                                    <input type="password"
                                           id="current_password"
                                           name="current_password"
                                           placeholder="Masukkan password lama"
                                           class="w-full px-4 py-2.5 pr-10 border border-gray-200 rounded-xl focus:border-medium-blue focus:ring-2 focus:ring-medium-blue/20 transition-all duration-200 outline-none text-sm">
                                    <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center" onclick="togglePassword('current_password')">
                                        <svg id="current_password-eye-open" class="w-5 h-5 text-gray-400 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        <svg id="current_password-eye-closed" class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.99 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                                        </svg>
                                    </button>
                                </div>
                                @error('current_password')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Password Baru -->
                            <div>
                                <label for="new_password" class="block text-sm font-semibold text-gray-700 mb-2">Password Baru</label>
                                <div class="relative">
                                    <input type="password"
                                           id="new_password"
                                           name="new_password"
                                           placeholder="Masukkan password baru"
                                           class="w-full px-4 py-2.5 pr-10 border border-gray-200 rounded-xl focus:border-medium-blue focus:ring-2 focus:ring-medium-blue/20 transition-all duration-200 outline-none text-sm">
                                    <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center" onclick="togglePassword('new_password')">
                                        <svg id="new_password-eye-open" class="w-5 h-5 text-gray-400 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        <svg id="new_password-eye-closed" class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                                        </svg>
                                    </button>
                                </div>
                                @error('new_password')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Konfirmasi Password Baru -->
                            <div class="md:col-span-2">
                                <label for="new_password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">Konfirmasi Password Baru</label>
                                <div class="relative">
                                    <input type="password"
                                           id="new_password_confirmation"
                                           name="new_password_confirmation"
                                           placeholder="Ulangi password baru"
                                           class="w-full px-4 py-2.5 pr-10 border border-gray-200 rounded-xl focus:border-medium-blue focus:ring-2 focus:ring-medium-blue/20 transition-all duration-200 outline-none text-sm">
                                    <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center" onclick="togglePassword('new_password_confirmation')">
                                        <svg id="new_password_confirmation-eye-open" class="w-5 h-5 text-gray-400 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        <svg id="new_password_confirmation-eye-closed" class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                                        </svg>
                                    </button>
                                </div>
                                @error('new_password_confirmation')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-8">
                            <button type="submit"
                                    class="w-full bg-gradient-to-r from-medium-blue to-blue-600 text-white px-5 py-3 rounded-xl font-medium text-sm hover:from-dark-blue hover:to-blue-700 transition-all duration-300 shadow-sm hover:shadow-md">
                                Ubah Password
                            </button>
                        </div>
                    </form>
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

        /* Better focus states for accessibility */
        button:focus-visible,
        input:focus-visible,
        select:focus-visible {
            outline: 2px solid #3B82F6;
            outline-offset: 2px;
        }
    </style>

    @include('partials.confirmation-modal')

    <script>
        // Add confirmation to password change form
        document.addEventListener('DOMContentLoaded', function() {
            const passwordForm = document.querySelector('form[action="{{ route('admin.update.password') }}"]');
            if (passwordForm) {
                const originalSubmit = passwordForm.onsubmit;
                passwordForm.onsubmit = function(e) {
                    e.preventDefault();

                    showSaveConfirmation(
                        "Apakah Anda yakin ingin mengubah password Anda?",
                        function() {
                            if (originalSubmit) {
                                originalSubmit.call(passwordForm);
                            } else {
                                passwordForm.submit();
                            }
                        }
                    );
                };
            }
        });
    </script>
</body>
</html>