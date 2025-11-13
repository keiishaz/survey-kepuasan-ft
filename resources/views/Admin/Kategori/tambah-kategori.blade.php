<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPULAS - Tambah Kategori</title>
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
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif; }
        .card-hover { transition: all .3s cubic-bezier(.4,0,.2,1); will-change: transform, box-shadow; }
        .card-hover:hover { transform: translateY(-2px); box-shadow: 0 12px 24px rgba(0,0,0,.06); }
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background:#f1f1f1; border-radius:10px; }
        ::-webkit-scrollbar-thumb { background:#3B82F6; border-radius:10px; }
        ::-webkit-scrollbar-thumb:hover { background:#1E3A8A; }
        button:focus-visible, input:focus-visible { outline:2px solid #3B82F6; outline-offset:2px; }
        #sidebar { transition: transform .3s cubic-bezier(.4,0,.2,1); }
        @media (max-width:1023px){
            #sidebar { transform: translateX(-100%); left:1rem; width:calc(100% - 2rem); max-width:280px; }
            #sidebar.translate-x-0 { transform: translateX(0); }
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

    <!-- Main -->
    <main class="flex-1 lg:ml-72 p-6 lg:p-8 lg:pr-6">
        <!-- Header -->
        <div class="mb-6 lg:mt-0 mt-16">
            <h1 class="text-xl font-bold text-gray-900 mb-1">Tambah Kategori</h1>
            <p class="text-xs text-gray-600">Form untuk menambahkan kategori baru pada sistem</p>
        </div>

        <!-- Card Form -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 md:p-6">

            <!-- Form -->
            <form method="POST" action="{{ route('kategori.simpan') }}" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1.5">Nama Kategori</label>
                    <div class="relative">
                        <input
                            type="text"
                            name="nama"
                            placeholder="Masukkan nama kategori"
                            class="w-full px-3 py-2 pl-3 border border-gray-200 rounded-xl focus:border-medium-blue focus:ring-2 focus:ring-medium-blue/20 transition-all duration-200 outline-none text-sm"
                            value="{{ old('nama') }}"
                            required
                        >
                        @error('nama')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="pt-2 flex items-center gap-3">
                    <button type="submit"
                            class="bg-gradient-to-r from-medium-blue to-blue-600 text-white px-4 py-2 rounded-xl font-medium text-sm hover:from-dark-blue hover:to-blue-700 transition-all duration-300 shadow-sm hover:shadow-md flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan
                    </button>

                    <a href="{{ route('kategori') }}"
                       class="px-4 py-2 rounded-xl border border-gray-200 text-gray-700 text-sm font-medium hover:bg-gray-50 transition-all duration-200">
                        Batal
                    </a>
                </div>
            </form>
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
</body>
</html>
