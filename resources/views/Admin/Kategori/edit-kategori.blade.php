<!DOCTYPE html>
<html lang="id">
<head>
    @include('partials.head')
    <title>SIPULAS - Edit Kategori</title>
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
                            <h1 class="text-xl font-semibold text-gray-800">Edit Kategori</h1>
                            <p class="text-sm text-gray-500 mt-0.5">Perbarui nama kategori</p>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <div class="p-6 lg:p-8">

                <div class="bg-white rounded-2xl shadow-sm p-4 mb-6 border border-gray-100">
                    <form method="POST" action="{{ route('kategori.update', $kategori->id_kategori) }}" class="space-y-5">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1.5">Nama Kategori</label>
                            <input type="text" name="nama" required
                                   value="{{ old('nama', $kategori->nama) }}"
                                   placeholder="Masukkan nama kategori"
                                   class="w-full px-3 py-2 border border-gray-200 rounded-xl focus:border-medium-blue focus:ring-2 focus:ring-medium-blue/20 transition-all duration-200 outline-none text-sm text-gray-900 bg-white">
                            @error('nama')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="pt-2 flex items-center gap-3">
                            <button type="submit"
                                    class="bg-gradient-to-r from-medium-blue to-blue-600 text-white px-4 py-2 rounded-xl font-medium text-sm hover:from-dark-blue hover:to-blue-700 transition-all duration-300 shadow-sm hover:shadow-md flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                Perbarui
                            </button>
                            <a href="{{ route('kategori') }}" class="px-4 py-2 rounded-xl border border-gray-200 text-gray-700 text-sm font-medium hover:bg-gray-50 transition-all duration-200">Batal</a>
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
        // Add confirmation to edit category form
        document.addEventListener('DOMContentLoaded', function() {
            const editCategoryForm = document.querySelector('form[method="POST"]');
            if (editCategoryForm && editCategoryForm.action.includes('/kategori/') && editCategoryForm.querySelector('input[name="_method"][value="PUT"]')) {
                // Find the submit button and add confirmation to its click event
                const submitButton = editCategoryForm.querySelector('button[type="submit"]');
                if (submitButton) {
                    submitButton.addEventListener('click', function(e) {
                        e.preventDefault();

                        showSaveConfirmation(
                            "Apakah Anda yakin ingin memperbarui kategori ini?",
                            function() {
                                editCategoryForm.submit();
                            }
                        );
                    });
                }
            }
        });
    </script>
    @fluxScripts
</body>
</html>
