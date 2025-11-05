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
        @include('navbar')

        <!-- Mobile Sidebar Toggle -->
        <button class="fixed top-6 left-6 z-50 lg:hidden bg-white p-3 rounded-xl shadow-lg" id="sidebar-toggle">
            <svg class="w-5 h-5 text-dark-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>

        <!-- Main Content -->
        <main class="flex-1 lg:ml-72 p-6 lg:p-8 lg:pr-6">
            <!-- Header -->
            <div class="mb-6">
                <h1 class="text-xl font-bold text-gray-900 mb-1">Manajemen Form</h1>
                <p class="text-xs text-gray-600">Kelola semua form survey dalam sistem</p>
            </div>

            <!-- Filter Section -->
            <div class="bg-white rounded-2xl shadow-sm p-5 mb-6 border border-gray-100">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Search -->
                    <div class="lg:col-span-2">
                        <label class="block text-xs font-semibold text-gray-700 mb-2">Cari Form</label>
                        <div class="relative">
                            <input type="text" 
                                   placeholder="Cari berdasarkan judul form..." 
                                   class="w-full px-4 py-2.5 pl-10 border border-gray-200 rounded-xl focus:border-medium-blue focus:ring-2 focus:ring-medium-blue/20 transition-all duration-200 outline-none text-sm">
                            <svg class="w-4 h-4 text-gray-400 absolute left-3.5 top-1/2 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Kategori Filter -->
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-2">Kategori</label>
                        <select class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:border-medium-blue focus:ring-2 focus:ring-medium-blue/20 transition-all duration-200 outline-none bg-white text-sm">
                            <option value="">Semua Kategori</option>
                            <option value="akademik">Akademik</option>
                            <option value="fasilitas">Fasilitas</option>
                            <option value="layanan">Layanan</option>
                            <option value="dosen">Dosen</option>
                        </select>
                    </div>

                    <!-- Status Filter -->
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-2">Status</label>
                        <select class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:border-medium-blue focus:ring-2 focus:ring-medium-blue/20 transition-all duration-200 outline-none bg-white text-sm">
                            <option value="">Semua Status</option>
                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Nonaktif</option>
                        </select>
                    </div>
                </div>

                <!-- Button Buat Form -->
                <div class="mt-5 pt-5 border-t border-gray-100">
                    <button class="bg-gradient-to-r from-medium-blue to-blue-600 text-white px-5 py-2.5 rounded-xl font-medium text-sm hover:from-dark-blue hover:to-blue-700 transition-all duration-300 shadow-sm hover:shadow-md flex items-center space-x-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        <a href="{{ url('/form/tambah') }}" class="...">Buat Form Baru</a>
                    </button>
                </div>
            </div>

        <!-- Form Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
            @forelse ($forms as $form)
                @php
                    $isActive = $form->is_active; // accessor
                    $statusText = $isActive ? 'Aktif' : 'Nonaktif';
                    $statusClass = $isActive ? 'bg-green-500' : 'bg-gray-400';

                    // warna badge kategori (opsional random/berdasar nama)
                    $kat = strtolower($form->kategori->nama ?? '-');
                    $badgeMap = [
                        'akademik' => ['text'=>'text-blue-600','bg'=>'bg-blue-50'],
                        'fasilitas'=> ['text'=>'text-orange-600','bg'=>'bg-orange-50'],
                        'layanan'  => ['text'=>'text-purple-600','bg'=>'bg-purple-50'],
                        'dosen'    => ['text'=>'text-emerald-600','bg'=>'bg-emerald-50'],
                    ];
                    $c = $badgeMap[$kat] ?? ['text'=>'text-gray-700','bg'=>'bg-gray-100'];

                    // gradient header (opsional sederhana)
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
                                 class="w-full h-24 object-cover">
                        @else
                            <div class="bg-gradient-to-br {{ $grad }} h-24 w-full"></div>
                        @endif
                        <span class="absolute top-3 right-3 {{ $statusClass }} text-white text-xs font-semibold px-3 py-1 rounded-full shadow-sm">
                            {{ $statusText }}
                        </span>
                    </div>

                    <!-- Card Content -->
                    <div class="p-5">
                        <div class="mb-3">
                            <span class="text-xs font-semibold {{ $c['text'] }} {{ $c['bg'] }} px-2.5 py-1 rounded-lg">
                                {{ $form->kategori->nama ?? '-' }}
                            </span>
                        </div>

                        <h3 class="text-base font-bold text-gray-900 mb-3 line-clamp-2">{{ $form->nama }}</h3>

                        <div class="flex items-center space-x-2 text-gray-600 mb-4">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                            <span class="text-sm font-medium">{{ $form->responden_count }} Responden</span>
                        </div>

                        <a href="{{ route('forms.show', $form->id_kuesioner) }}" class="w-full inline-flex items-center justify-center bg-medium-blue text-white py-2.5 px-4 rounded-lg font-medium hover:bg-dark-blue transition-all duration-200 text-sm">
                            Kelola Form
                        </a>

                        <div class="mt-3 text-[11px] text-gray-500">
                            <span>Mulai: {{ $form->tanggal_mulai?->format('Y-m-d') ?? '-' }}</span>
                            <span class="mx-2">•</span>
                            <span>Selesai: {{ $form->tanggal_selesai?->format('Y-m-d') ?? '-' }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center text-gray-600 bg-white rounded-xl py-10 border border-dashed">
                    Belum ada form. <a href="{{ route('forms.create') }}" class="text-medium-blue font-semibold hover:underline">Buat Form Baru</a>
                </div>
            @endforelse
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