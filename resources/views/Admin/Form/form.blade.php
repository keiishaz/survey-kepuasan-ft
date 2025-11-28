<!DOCTYPE html>
<html lang="id">
<head>
    @include('partials.head')
    <title>SIPULAS - Manajemen Form</title>
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
                                           class="w-full px-4 py-2.5 pl-10 border border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-all duration-200 outline-none text-sm text-gray-900">
                                    <svg class="w-4 h-4 text-gray-400 absolute left-3.5 top-1/2 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                            </div>

                            <!-- Kategori Filter -->
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 mb-2">Kategori</label>
                                <select name="category"
                                        class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-all duration-200 outline-none bg-white text-sm text-gray-900">
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
                                        class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-all duration-200 outline-none bg-white text-sm text-gray-900">
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

                <!-- Form List Table -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50/50">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Gambar</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Nama Form</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Kategori</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Tanggal</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Responden</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-20 py-4 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
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
                                    @endphp

                                    <tr class="hover:bg-gray-50/50 transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="w-16 h-10">
                                                @if($form->sampul)
                                                    <img src="{{ asset('storage/'.$form->sampul) }}" alt="Sampul" class="w-full h-full object-cover rounded-md border border-gray-200">
                                                @else
                                                    <div class="w-full h-full bg-gray-100 rounded-md border border-gray-200 flex items-center justify-center">
                                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                        </svg>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <p class="text-sm font-semibold text-gray-900">{{ $form->nama }}</p>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $c['text'] }} {{ $c['bg'] }} border {{ $c['border'] }}">
                                                {{ $form->kategori->nama ?? '-' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-600">
                                                <p>{{ $form->tanggal_mulai?->format('d/m/Y') ?? '-' }}</p>
                                                <p class="text-gray-400 text-xs">s/d {{ $form->tanggal_selesai?->format('d/m/Y') ?? '-' }}</p>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center space-x-2 text-gray-500">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                                </svg>
                                                <span class="text-sm font-medium">{{ $form->respondens_count }} Responden</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusClass }}">
                                                <span class="w-1.5 h-1.5 rounded-full mr-1.5 {{ $isActive ? 'bg-green-500' : 'bg-gray-400' }}"></span>
                                                {{ $statusText }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <a href="{{ route('forms.show', $form->id_kuesioner) }}" class="inline-flex items-center bg-primary-500 text-white px-4 py-2 rounded-lg font-medium hover:bg-primary-600 transition-all duration-200 text-sm">
                                                Kelola Form
                                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center">
                                                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-3">
                                                    <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                                    </svg>
                                                </div>
                                                <p class="text-gray-600 font-medium mb-2">Belum ada form</p>
                                                <a href="{{ route('forms.create') }}" class="text-primary-600 font-semibold hover:text-primary-700">Buat Form Baru</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
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

    <!-- Universal Confirmation Modal -->
    <div id="confirmationModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" aria-hidden="true"></div>
        <div class="flex min-h-full items-center justify-center p-4">
            <div class="relative transform overflow-hidden rounded-xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                        </div>
                        <div class="mt-4 text-center sm:mt-0 sm:text-left w-full">
                            <h3 class="text-lg font-semibold leading-6 text-gray-900" id="modalTitle">Konfirmasi Tindakan</h3>
                            <div class="mt-4">
                                <p class="text-sm text-gray-500" id="modalMessage">Apakah Anda yakin ingin melakukan tindakan ini?</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                    <button type="button" id="confirmButton" class="inline-flex w-full justify-center rounded-md bg-red-600 px-4 py-2 text-base font-semibold text-white shadow-sm hover:bg-red-700 sm:ml-3 sm:w-auto sm:text-sm">
                        Ya, Lanjutkan
                    </button>
                    <button type="button" id="cancelButton" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-4 py-2 text-base font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto sm:text-sm">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Universal confirmation function
        function showConfirmation(title, message, onConfirm) {
            document.getElementById('modalTitle').textContent = title;
            document.getElementById('modalMessage').innerHTML = message;
            document.getElementById('confirmationModal').classList.remove('hidden');

            // Set the callback function
            window.currentConfirmCallback = onConfirm;
        }

        function hideConfirmation() {
            document.getElementById('confirmationModal').classList.add('hidden');
        }

        // Event listeners for confirmation modal
        document.getElementById('confirmButton').addEventListener('click', function() {
            if (typeof window.currentConfirmCallback === 'function') {
                window.currentConfirmCallback();
            }
            hideConfirmation();
        });

        document.getElementById('cancelButton').addEventListener('click', hideConfirmation);

        // Close modal when clicking outside the modal content
        document.getElementById('confirmationModal').addEventListener('click', function(e) {
            if (e.target === this) {
                hideConfirmation();
            }
        });

        // Enhanced delete functions using universal modal
        function showDeleteConfirmation(id, name, deleteUrl) {
            showConfirmation(
                "Konfirmasi Penghapusan",
                `Apakah Anda yakin ingin menghapus <span class="font-semibold">${name}</span>? Tindakan ini tidak dapat dibatalkan.`,
                function() {
                    // Create and submit a form for deletion
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = deleteUrl;
                    form.style.display = 'none';

                    const token = document.createElement('input');
                    token.type = 'hidden';
                    token.name = '_token';
                    token.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    const method = document.createElement('input');
                    method.type = 'hidden';
                    method.name = '_method';
                    method.value = 'DELETE';

                    form.appendChild(token);
                    form.appendChild(method);
                    document.body.appendChild(form);
                    form.submit();
                }
            );
        }

        // Enhanced save/update function using universal modal
        function showSaveConfirmation(message, onConfirm) {
            showConfirmation(
                "Konfirmasi Penyimpanan",
                message,
                onConfirm
            );
        }

        // Set up all delete buttons on the page
        document.addEventListener('DOMContentLoaded', function() {
            // Add CSRF token meta tag if not present
            if (!document.querySelector('meta[name="csrf-token"]')) {
                const meta = document.createElement('meta');
                meta.name = 'csrf-token';
                meta.content = document.querySelector('input[name="_token"]').value;
                document.head.appendChild(meta);
            }

            // Initialize all delete buttons with confirmation
            const deleteButtons = document.querySelectorAll('[data-delete-url]');
            deleteButtons.forEach(function(button) {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const url = this.getAttribute('data-delete-url');
                    const name = this.getAttribute('data-item-name') || 'item';
                    const id = this.getAttribute('data-item-id');
                    showDeleteConfirmation(id, name, url);
                });
            });
        });
    </script>

    @include('partials.confirmation-modal')
    @fluxScripts
</body>
</html>