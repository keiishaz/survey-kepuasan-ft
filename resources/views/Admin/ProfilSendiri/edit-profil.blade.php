<!DOCTYPE html>
<html lang="id">
<head>
    @include('partials.head')
    <title>SIPULAS - Edit Profil Sendiri</title>
    <style>
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="flex min-h-screen">
        @include('Admin.navbar')

        <!-- Main Content -->
        <main class="flex-1 lg:ml-64">
            <!-- Top Header Bar -->
            <header class="bg-white border-b border-gray-200 sticky top-0 z-30">
                <div class="px-6 lg:px-8 py-4">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <!-- Mobile Menu Button -->
                            <button class="lg:hidden mr-3 bg-white p-2 rounded-lg shadow-sm border border-gray-200" id="sidebar-toggle">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                            </button>
                            <div>
                                <h1 class="text-xl font-semibold text-gray-800">Edit Profil Sendiri</h1>
                                <p class="text-sm text-gray-500 mt-0.5">Form untuk mengubah informasi profil dan password Anda</p>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <div class="p-6 lg:p-8">

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

                <!-- Form Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 md:p-6">

                    <!-- Form Edit Profil -->
                    <form action="{{ route('admin.update.profil') }}" method="POST" class="space-y-5 mb-8">
                        @csrf
                        @method('PUT')

                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Edit Profil</h2>

                        <div class="space-y-5">
                            <!-- Nama Admin -->
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 mb-1.5">Nama Lengkap</label>
                                <div class="relative">
                                    <input
                                        type="text"
                                        name="nama"
                                        placeholder="Masukkan nama lengkap Anda"
                                        class="w-full px-3 py-2 pl-3 border border-gray-200 rounded-xl focus:border-medium-blue focus:ring-2 focus:ring-medium-blue/20 transition-all duration-200 outline-none text-sm text-gray-900 bg-white"
                                        value="{{ old('nama', $admin->nama) }}"
                                        required
                                    >
                                    @error('nama')
                                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Email -->
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 mb-1.5">Alamat Email</label>
                                <div class="relative">
                                    <input
                                        type="email"
                                        name="email"
                                        placeholder="Masukkan alamat email Anda"
                                        class="w-full px-3 py-2 pl-3 border border-gray-200 rounded-xl focus:border-medium-blue focus:ring-2 focus:ring-medium-blue/20 transition-all duration-200 outline-none text-sm text-gray-900 bg-white"
                                        value="{{ old('email', $admin->email) }}"
                                        required
                                    >
                                    @error('email')
                                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="pt-3">
                            <button type="submit"
                                    class="bg-gradient-to-r from-medium-blue to-blue-600 text-white px-4 py-2 rounded-xl font-medium text-sm hover:from-dark-blue hover:to-blue-700 transition-all duration-300 shadow-sm hover:shadow-md flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Perbarui Profil
                            </button>
                        </div>
                    </form>

                    <hr class="border-gray-200 my-6">

                    <!-- Form Ganti Password -->
                    <form action="{{ route('admin.update.password') }}" method="POST" class="space-y-5">
                        @csrf
                        @method('PUT')

                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Ubah Password</h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <!-- Password Lama -->
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 mb-1.5">Password Lama</label>
                                <div class="relative">
                                    <input
                                        type="password"
                                        name="current_password"
                                        id="current_password"
                                        placeholder="Masukkan password lama"
                                        class="w-full px-3 py-2 pr-10 border border-gray-200 rounded-xl focus:border-medium-blue focus:ring-2 focus:ring-medium-blue/20 transition-all duration-200 outline-none text-sm text-gray-900 bg-white"
                                    >
                                    <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center" onclick="togglePassword('current_password')">
                                        <svg id="current_password-eye-open" class="w-4 h-4 text-gray-400 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        <svg id="current_password-eye-closed" class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                                        </svg>
                                    </button>
                                </div>
                                @error('current_password')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Password Baru -->
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 mb-1.5">Password Baru</label>
                                <div class="relative">
                                    <input
                                        type="password"
                                        name="new_password"
                                        id="new_password"
                                        placeholder="Masukkan password baru"
                                        class="w-full px-3 py-2 pr-10 border border-gray-200 rounded-xl focus:border-medium-blue focus:ring-2 focus:ring-medium-blue/20 transition-all duration-200 outline-none text-sm text-gray-900 bg-white"
                                    >
                                    <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center" onclick="togglePassword('new_password')">
                                        <svg id="new_password-eye-open" class="w-4 h-4 text-gray-400 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        <svg id="new_password-eye-closed" class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                                        </svg>
                                    </button>
                                </div>
                                @error('new_password')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Konfirmasi Password Baru -->
                            <div class="md:col-span-2">
                                <label class="block text-xs font-semibold text-gray-700 mb-1.5">Konfirmasi Password Baru</label>
                                <div class="relative">
                                    <input
                                        type="password"
                                        name="new_password_confirmation"
                                        id="new_password_confirmation"
                                        placeholder="Ulangi password baru"
                                        class="w-full px-3 py-2 pr-10 border border-gray-200 rounded-xl focus:border-medium-blue focus:ring-2 focus:ring-medium-blue/20 transition-all duration-200 outline-none text-sm text-gray-900 bg-white"
                                    >
                                    <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center" onclick="togglePassword('new_password_confirmation')">
                                        <svg id="new_password_confirmation-eye-open" class="w-4 h-4 text-gray-400 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        <svg id="new_password_confirmation-eye-closed" class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                                        </svg>
                                    </button>
                                </div>
                                @error('new_password_confirmation')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="pt-3 flex items-center gap-3">
                            <button type="submit"
                                    class="bg-gradient-to-r from-medium-blue to-blue-600 text-white px-4 py-2 rounded-xl font-medium text-sm hover:from-dark-blue hover:to-blue-700 transition-all duration-300 shadow-sm hover:shadow-md flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Ubah Password
                            </button>
                            <a href="{{ route('dashboard') }}"
                               class="px-4 py-2 bg-gray-100 text-gray-700 font-medium rounded-xl text-sm hover:bg-gray-200 transition-all duration-200 shadow-sm hover:shadow-md">
                                Batal
                            </a>
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

        button:focus-visible, input:focus-visible {
            outline: 2px solid #3B82F6;
            outline-offset: 2px;
        }
    </style>

    @include('partials.confirmation-modal')

    <script>
        // Add confirmation to form submissions
        document.addEventListener('DOMContentLoaded', function() {
            const profileForm = document.querySelector('form[action="{{ route('admin.update.profil') }}"]');
            if (profileForm) {
                const originalSubmit = profileForm.onsubmit;
                profileForm.onsubmit = function(e) {
                    e.preventDefault();

                    showSaveConfirmation(
                        "Apakah Anda yakin ingin memperbarui profil Anda?",
                        function() {
                            if (originalSubmit) {
                                originalSubmit.call(profileForm);
                            } else {
                                profileForm.submit();
                            }
                        }
                    );
                };
            }

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
    @fluxScripts
</body>
</html>