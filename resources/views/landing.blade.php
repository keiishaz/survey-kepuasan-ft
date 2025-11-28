<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPULAS - Sistem Survey Kepuasan Layanan FT UNIB</title>
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
                    },
                    animation: {
                        'fade-in': 'fadeIn 1s ease-in-out',
                        'slide-up': 'slideUp 0.8s ease-out',
                        'float': 'float 3s ease-in-out infinite',
                        'pulse-glow': 'pulseGlow 2s infinite'
                    }
                }
            }
        }
    </script>
    <style>
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes slideUp {
            from { transform: translateY(50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        @keyframes pulseGlow {
            0%, 100% { box-shadow: 0 0 20px rgba(59, 130, 246, 0.5); }
            50% { box-shadow: 0 0 30px rgba(59, 130, 246, 0.8); }
        }
        .gradient-bg {
            background: linear-gradient(135deg, #E8F4FD 0%, #FEF9E7 50%, #B8E0FF 100%);
        }
        .glass-effect {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.25);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body class="gradient-bg min-h-screen">
    <!-- Navigation -->
    <nav class="bg-white/80 backdrop-blur-md border-b border-gray-200 sticky top-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-3">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 flex items-center justify-center flex-shrink-0">
                        <img src="{{ asset('images/logounib.png') }}" alt="Logo UNIB" class="h-full w-full object-contain">
                    </div>
                    <div>
                        <h1 class="text-lg font-bold text-dark-blue">SIPULAS</h1>
                        <p class="text-xs text-gray-600">FT UNIB</p>
                    </div>
                </div>

                <!-- Mobile menu button -->
                <button class="md:hidden text-dark-blue p-2 rounded-lg hover:bg-pastel-blue/30 transition-colors" id="mobile-menu-btn">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-2">
                    <a href="#home" class="px-4 py-2 text-sm text-gray-700 hover:text-white hover:bg-gradient-to-r hover:from-medium-blue hover:to-dark-blue transition-all duration-300 font-medium rounded-lg border border-gray-300 hover:border-medium-blue shadow-sm hover:shadow-md">Beranda</a>
                    <a href="#about" class="px-4 py-2 text-sm text-gray-700 hover:text-white hover:bg-gradient-to-r hover:from-medium-blue hover:to-dark-blue transition-all duration-300 font-medium rounded-lg border border-gray-300 hover:border-medium-blue shadow-sm hover:shadow-md">Tentang</a>
                    <a href="#statistics" class="px-4 py-2 text-sm text-gray-700 hover:text-white hover:bg-gradient-to-r hover:from-medium-blue hover:to-dark-blue transition-all duration-300 font-medium rounded-lg border border-gray-300 hover:border-medium-blue shadow-sm hover:shadow-md">Statistik</a>
                    <a href="#contact" class="px-4 py-2 text-sm text-gray-700 hover:text-white hover:bg-gradient-to-r hover:from-medium-blue hover:to-dark-blue transition-all duration-300 font-medium rounded-lg border border-gray-300 hover:border-medium-blue shadow-sm hover:shadow-md">Kontak</a>
                    <a href="{{ url('/login') }}" class="px-4 py-2 text-sm text-gray-700 hover:text-white hover:bg-gradient-to-r hover:from-dark-blue hover:to-indigo-700 transition-all duration-300 font-medium rounded-lg border border-gray-300 hover:border-dark-blue shadow-sm hover:shadow-md">Masuk</a>
                </div>
            </div>

            <!-- Mobile Navigation Menu -->
            <div class="md:hidden hidden pb-4 space-y-2" id="mobile-menu">
                <a href="#home" class="block text-sm text-gray-700 hover:text-white hover:bg-gradient-to-r hover:from-medium-blue hover:to-dark-blue transition-all duration-300 font-medium px-3 py-2 rounded-lg border border-gray-300 hover:border-medium-blue shadow-sm hover:shadow-md">Beranda</a>
                <a href="#about" class="block text-sm text-gray-700 hover:text-white hover:bg-gradient-to-r hover:from-medium-blue hover:to-dark-blue transition-all duration-300 font-medium px-3 py-2 rounded-lg border border-gray-300 hover:border-medium-blue shadow-sm hover:shadow-md">Tentang</a>
                <a href="#statistics" class="block text-sm text-gray-700 hover:text-white hover:bg-gradient-to-r hover:from-medium-blue hover:to-dark-blue transition-all duration-300 font-medium px-3 py-2 rounded-lg border border-gray-300 hover:border-medium-blue shadow-sm hover:shadow-md">Statistik</a>
                <a href="#contact" class="block text-sm text-gray-700 hover:text-white hover:bg-gradient-to-r hover:from-medium-blue hover:to-dark-blue transition-all duration-300 font-medium px-3 py-2 rounded-lg border border-gray-300 hover:border-medium-blue shadow-sm hover:shadow-md">Kontak</a>
                <a href="{{ url('/login') }}" class="block text-sm text-gray-700 hover:text-white hover:bg-gradient-to-r hover:from-dark-blue hover:to-indigo-700 transition-all duration-300 font-medium px-3 py-2 rounded-lg border border-gray-300 hover:border-dark-blue shadow-sm hover:shadow-md">Masuk</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="pt-16 pb-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="animate-slide-up">
                    <h2 class="text-5xl md:text-6xl font-bold text-dark-blue mb-6 leading-tight">
                        Sistem Survey Kepuasan
                        <span class="text-medium-blue">Layanan</span>
                    </h2>
                    <p class="text-xl text-gray-700 mb-8 leading-relaxed">
                        SIPULAS merupakan platform evaluasi kepuasan layanan yang menyediakan sarana
                        bagi civitas akademika dan stakeholder untuk memberikan penilaian terhadap
                        kualitas layanan di Fakultas Teknik Universitas Bengkulu.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-6">
                        <a href="{{ url('/cari-survey') }}">
                            <button class="group bg-medium-blue text-white px-10 py-5 rounded-xl font-semibold text-lg hover:bg-dark-blue transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-2xl border-2 border-transparent focus:ring-4 focus:ring-medium-blue/30">
                                <span class="flex items-center justify-center space-x-2">
                                    <span>Isi Survey Sekarang</span>
                                </span>
                            </button>
                        </a>
                        <button class="group bg-white text-dark-blue border-3 border-medium-blue px-10 py-5 rounded-xl font-semibold text-lg hover:bg-medium-blue hover:text-white transition-all duration-300 shadow-lg hover:shadow-2xl focus:ring-4 focus:ring-medium-blue/30">
                            <span class="flex items-center justify-center space-x-2">
                                <span>Panduan Pengisian</span>
                            </span>
                        </button>
                    </div>
                </div>
                <div class="animate-float">
                    <!-- Gambar tanpa kotak dan shadow -->
                    <div class="text-center">
                        <img src="{{ asset('images/gambar1.png') }}"
                             alt="Ilustrasi Sistem SIPULAS"
                             class="w-full h-auto max-w-lg mx-auto rounded-2xl"
                             loading="lazy">
                        <!-- Fallback jika gambar tidak ada -->
                        <div class="w-full h-80 bg-gradient-to-br from-pastel-blue via-white to-cream rounded-2xl flex items-center justify-center"
                             style="display: none;" id="fallback-content">
                            <div class="text-center">
                                <div class="w-20 h-20 bg-medium-blue/20 rounded-full mx-auto mb-4 animate-pulse flex items-center justify-center">
                                    <div class="w-10 h-10 bg-medium-blue/40 rounded-full animate-ping"></div>
                                </div>
                                <p class="text-dark-blue/60 text-lg font-medium">Memuat ilustrasi...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-dark-blue mb-4">Tentang SIPULAS</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Sistem evaluasi yang mendukung peningkatan kualitas layanan akademik dan administratif
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-gradient-to-br from-pastel-blue/60 to-light-blue/40 border border-pastel-blue/20 backdrop-blur-sm p-8 rounded-2xl text-center hover:transform hover:scale-105 transition-all duration-300 hover:shadow-xl hover:from-pastel-blue/80 hover:to-light-blue/60">
                    <div class="w-16 h-16 bg-gradient-to-br from-medium-blue to-dark-blue rounded-full mx-auto mb-6 flex items-center justify-center shadow-lg">
                        <!-- Target Icon -->
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-dark-blue mb-4">Tujuan</h3>
                    <p class="text-gray-700 leading-relaxed">
                        Mengumpulkan data evaluasi kepuasan layanan secara sistematis dan objektif
                        untuk mendukung perbaikan berkelanjutan.
                    </p>
                </div>

                <div class="bg-gradient-to-br from-cream/80 to-orange-100/60 border border-orange-200/40 backdrop-blur-sm p-8 rounded-2xl text-center hover:transform hover:scale-105 transition-all duration-300 hover:shadow-xl hover:from-cream hover:to-orange-100/80">
                    <div class="w-16 h-16 bg-gradient-to-br from-orange-400 to-orange-600 rounded-full mx-auto mb-6 flex items-center justify-center shadow-lg">
                        <!-- Chart Icon -->
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-dark-blue mb-4">Metode</h3>
                    <p class="text-gray-700 leading-relaxed">
                        Menggunakan instrumen evaluasi terstruktur dengan pendekatan kuantitatif
                        dan kualitatif untuk mengukur tingkat kepuasan layanan.
                    </p>
                </div>

                <div class="bg-gradient-to-br from-green-50/80 to-emerald-100/60 border border-green-200/40 backdrop-blur-sm p-8 rounded-2xl text-center hover:transform hover:scale-105 transition-all duration-300 hover:shadow-xl hover:from-green-100/80 hover:to-emerald-100/80">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-600 rounded-full mx-auto mb-6 flex items-center justify-center shadow-lg">
                        <!-- Refresh Icon -->
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-dark-blue mb-4">Manfaat</h3>
                    <p class="text-gray-700 leading-relaxed">
                        Menyediakan data akurat untuk pengambilan keputusan dalam upaya
                        peningkatan kualitas layanan di lingkungan Fakultas Teknik.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section id="statistics" class="py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-dark-blue mb-4">Statistik SIPULAS</h2>
                <p class="text-xl text-gray-600">Data partisipasi survey dalam sistem SIPULAS</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
                <!-- Total Responden Card -->
                <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-200">
                    <div class="text-center">
                        <div class="text-3xl md:text-4xl font-bold text-dark-blue mb-2">
                            {{ number_format($totalResponden) }}
                        </div>
                        <div class="text-gray-700 text-sm md:text-base font-medium">Total Responden</div>
                        <div class="mt-3">
                            <div class="w-12 h-12 mx-auto bg-pastel-blue/50 rounded-full flex items-center justify-center shadow-sm">
                                <svg class="w-6 h-6 text-dark-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Survey Aktif Card -->
                <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-200">
                    <div class="text-center">
                        <div class="text-3xl md:text-4xl font-bold text-dark-blue mb-2">
                            {{ number_format($totalSurveyAktif) }}
                        </div>
                        <div class="text-gray-700 text-sm md:text-base font-medium">Survey Aktif</div>
                        <div class="mt-3">
                            <div class="w-12 h-12 mx-auto bg-purple-100/50 rounded-full flex items-center justify-center shadow-sm">
                                <svg class="w-6 h-6 text-dark-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tingkat Kepuasan Rata-rata Card -->
                <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-200">
                    <div class="text-center">
                        <div class="text-3xl md:text-4xl font-bold text-dark-blue mb-2">
                            {{ number_format($tingkatKepuasanRata, 1) }}%
                        </div>
                        <div class="text-gray-700 text-sm md:text-base font-medium">Tingkat Kepuasan Rata-rata</div>
                        <div class="mt-3">
                            <div class="w-12 h-12 mx-auto bg-green-100/50 rounded-full flex items-center justify-center shadow-sm">
                                <svg class="w-6 h-6 text-dark-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Jumlah Responden Bulan Ini Card -->
                <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-200">
                    <div class="text-center">
                        <div class="text-3xl md:text-4xl font-bold text-dark-blue mb-2">
                            {{ number_format($jumlahRespondenBulanIni) }}
                        </div>
                        <div class="text-gray-700 text-sm md:text-base font-medium">Responden Bulan Ini</div>
                        <div class="mt-3">
                            <div class="w-12 h-12 mx-auto bg-amber-100/50 rounded-full flex items-center justify-center shadow-sm">
                                <svg class="w-6 h-6 text-dark-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Survey Terpopuler Detail -->
            @if($surveyTerpopuler && $surveyTerpopuler->count() > 0)
            <div class="bg-white/80 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden">
                <div class="bg-gradient-to-r from-medium-blue to-dark-blue p-6">
                    <h3 class="text-2xl font-bold text-white text-center">Survey Terpopuler Bulan Ini</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        @foreach($surveyTerpopuler as $index => $survey)
                        <div class="flex items-center justify-between p-5 bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                            <div class="flex items-center space-x-4">
                                <div class="w-10 h-10 flex items-center justify-center bg-gradient-to-r from-medium-blue to-dark-blue text-white rounded-lg font-bold text-sm shadow-md">
                                    {{ $index + 1 }}
                                </div>
                                <div class="min-w-0">
                                    <div class="font-semibold text-gray-800 truncate">{{ $survey->nama }}</div>
                                    <div class="text-sm text-gray-500 mt-1">
                                        {{ Str::limit($survey->deskripsi, 100) }}
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-lg font-bold text-medium-blue">{{ number_format($survey->total_responden) }}</div>
                                <div class="text-xs text-gray-500">responden</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @else
            <div class="bg-white/80 p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 text-center">
                <h3 class="text-2xl font-bold text-dark-blue mb-4">Survey Terpopuler Bulan Ini</h3>
                <p class="text-gray-600">Belum ada data survey terpopuler untuk bulan ini.</p>
            </div>
            @endif
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-24 bg-gradient-to-r from-medium-blue to-dark-blue">
        <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                Berpartisipasilah dalam Evaluasi
            </h2>
            <p class="text-xl text-blue-100 mb-8">
                Masukan Anda sangat berharga untuk peningkatan kualitas layanan Fakultas Teknik UNIB
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ url('/cari-survey') }}">
                    <button class="bg-white text-dark-blue px-8 py-4 rounded-xl font-semibold text-lg hover:bg-cream transition-all duration-300 transform hover:scale-105">
                        Mulai Survey
                    </button>
                </a>
                <a href="mailto:ft@unib.ac.id">
                    <button class="border-2 border-white text-white px-8 py-4 rounded-xl font-semibold text-lg hover:bg-white hover:text-dark-blue transition-all duration-300">
                        Hubungi Kami
                    </button>
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contact" class="bg-dark-blue text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8">
                <div class="md:col-span-2">
                    <div class="flex items-center space-x-4 mb-6">
                        <div class="w-12 h-12 flex items-center justify-center flex-shrink-0">
                            <img src="{{ asset('images/logounib.png') }}" alt="Logo UNIB" class="h-full w-full object-contain">
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold">SIPULAS</h3>
                            <p class="text-blue-200">Fakultas Teknik Universitas Bengkulu</p>
                        </div>
                    </div>
                    <p class="text-blue-200 leading-relaxed mb-6">
                        Sistem Survey Kepuasan Layanan yang dikembangkan untuk meningkatkan kualitas
                        layanan akademik dan administratif di lingkungan Fakultas Teknik UNIB.
                    </p>
                    <div class="flex justify-center md:justify-start space-x-4">
                        <a href="https://www.facebook.com/FakultasTeknikUNIB" class="w-10 h-10 bg-medium-blue rounded-full flex items-center justify-center hover:bg-light-blue transition-colors">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.879V14.89h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.989C18.343 21.129 22 16.99 22 12z"/>
                            </svg>
                        </a>
                        <a href="https://twitter.com/unibofficial" class="w-10 h-10 bg-medium-blue rounded-full flex items-center justify-center hover:bg-light-blue transition-colors">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"/>
                            </svg>
                        </a>
                        <a href="https://www.instagram.com/ftunib_official/" class="w-10 h-10 bg-medium-blue rounded-full flex items-center justify-center hover:bg-light-blue transition-colors">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd"/>
                            </svg>
                        </a>
                        <a href="https://www.youtube.com/@fakultasteknikuniversitasb8709" class="w-10 h-10 bg-medium-blue rounded-full flex items-center justify-center hover:bg-light-blue transition-colors">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M19.812 5.418c.861.23 1.538.907 1.768 1.768C21.998 8.746 22 12 22 12s0 3.255-.418 4.814a2.504 2.504 0 0 1-1.768 1.768c-1.56.419-7.814.419-7.814.419s-6.255 0-7.814-.419a2.505 2.505 0 0 1-1.768-1.768C2 15.255 2 12 2 12s0-3.255.417-4.814a2.507 2.507 0 0 1 1.768-1.768C5.744 5 11.998 5 11.998 5s6.255 0 7.814.418ZM15.194 12 10 15V9l5.194 3Z" clip-rule="evenodd"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <div>
                    <h4 class="text-xl font-semibold mb-4">Link Terkait</h4>
                    <ul class="space-y-2 text-blue-200">
                        <li><a href="https://www.unib.ac.id" class="hover:text-white transition-colors">Website Universitas Bengkulu</a></li>
                        <li><a href="https://www.unib.ac.id/fakultas/fakultas-teknik/" class="hover:text-white transition-colors">Website Fakultas Teknik UNIB</a></li>
                        <li><a href="https://pak.unib.ac.id" class="hover:text-white transition-colors">Portal Akademik</a></li>
                        <li><a href="https://elearning.unib.ac.id/" class="hover:text-white transition-colors">E-Learning</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-xl font-semibold mb-4">Kontak</h4>
                    <div class="space-y-3 text-blue-200">
                        <div class="flex items-start space-x-3">
                            <div>
                                <p>Jl. WR Supratman</p>
                                <p>Kandang Limun, Bengkulu</p>
                                <p>38371</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <a href="mailto:ft@unib.ac.id" class="hover:text-white transition-colors">ft@unib.ac.id</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="border-t border-blue-800 mt-12 pt-8 text-center text-blue-200">
                <p>&copy; 2025 SIPULAS - Fakultas Teknik Universitas Bengkulu. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu functionality
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');

            if (mobileMenuBtn && mobileMenu) {
                mobileMenuBtn.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');

                    const icon = mobileMenuBtn.querySelector('svg');
                    if (mobileMenu.classList.contains('hidden')) {
                        icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>';
                    } else {
                        icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>';
                    }
                });

                const mobileLinks = mobileMenu.querySelectorAll('a');
                mobileLinks.forEach(link => {
                    link.addEventListener('click', function() {
                        mobileMenu.classList.add('hidden');
                        const icon = mobileMenuBtn.querySelector('svg');
                        icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>';
                    });
                });
            }
        });

        // Handle image loading errors
        document.addEventListener('DOMContentLoaded', function() {
            const img = document.querySelector('img[src*="gambar1.png"]');
            const fallback = document.getElementById('fallback-content');

            if (img) {
                img.onerror = function() {
                    this.style.display = 'none';
                    if (fallback) {
                        fallback.style.display = 'flex';
                    }
                };

                img.onload = function() {
                    if (fallback) {
                        fallback.style.display = 'none';
                    }
                };
            }
        });

        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add animation on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-slide-up');
                }
            });
        }, observerOptions);

        document.querySelectorAll('section').forEach(section => {
            observer.observe(section);
        });

        // Interactive button effects
        document.querySelectorAll('button').forEach(button => {
            button.addEventListener('click', function() {
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 150);
            });
        });

        // Add interactive hover effects
        document.querySelectorAll('.glass-effect').forEach(element => {
            element.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
            });

            element.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    </script>
</body>
</html>