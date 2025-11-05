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
                <div class="hidden md:flex items-center space-x-6">
                    <a href="#home" class="text-sm text-gray-700 hover:text-medium-blue transition-colors font-medium">Beranda</a>
                    <a href="#about" class="text-sm text-gray-700 hover:text-medium-blue transition-colors font-medium">Tentang</a>
                    <a href="#statistics" class="text-sm text-gray-700 hover:text-medium-blue transition-colors font-medium">Statistik</a>
                    <a href="#contact" class="text-sm text-gray-700 hover:text-medium-blue transition-colors font-medium">Kontak</a>
                    <a href="{{ url('/login') }}" class="text-sm text-gray-700 hover:text-medium-blue transition-colors font-medium">Masuk</a>
                </div>
            </div>
            
            <!-- Mobile Navigation Menu -->
            <div class="md:hidden hidden pb-4 space-y-2" id="mobile-menu">
                <a href="#home" class="block text-sm text-gray-700 hover:text-medium-blue hover:bg-pastel-blue/20 transition-colors font-medium px-3 py-2 rounded-lg">Beranda</a>
                <a href="#about" class="block text-sm text-gray-700 hover:text-medium-blue hover:bg-pastel-blue/20 transition-colors font-medium px-3 py-2 rounded-lg">Tentang</a>
                <a href="#statistics" class="block text-sm text-gray-700 hover:text-medium-blue hover:bg-pastel-blue/20 transition-colors font-medium px-3 py-2 rounded-lg">Statistik</a>
                <a href="#contact" class="block text-sm text-gray-700 hover:text-medium-blue hover:bg-pastel-blue/20 transition-colors font-medium px-3 py-2 rounded-lg">Kontak</a>
                <a href="{{ url('/login') }}" class="block text-sm text-gray-700 hover:text-medium-blue hover:bg-pastel-blue/20 transition-colors font-medium px-3 py-2 rounded-lg">Masuk</a>
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
                        <button class="group bg-medium-blue text-white px-10 py-5 rounded-xl font-semibold text-lg hover:bg-dark-blue transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-2xl border-2 border-transparent focus:ring-4 focus:ring-medium-blue/30">
                            <span class="flex items-center justify-center space-x-2">
                                <span>Isi Survey Sekarang</span>
                            </span>
                        </button>
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
                <h2 class="text-4xl font-bold text-dark-blue mb-4">Statistik Responden</h2>
                <p class="text-xl text-gray-600">Data partisipasi survey dalam sistem SIPULAS</p>
            </div>
            
            <div class="grid md:grid-cols-4 gap-8 mb-12">
                <div class="bg-white/80 p-8 rounded-2xl text-center shadow-lg hover:shadow-xl transition-all duration-300">
                    <div class="text-4xl font-bold text-medium-blue mb-2">2,847</div>
                    <div class="text-gray-600">Total Responden</div>
                </div>
                <div class="bg-white/80 p-8 rounded-2xl text-center shadow-lg hover:shadow-xl transition-all duration-300">
                    <div class="text-4xl font-bold text-green-500 mb-2">89.2%</div>
                    <div class="text-gray-600">Tingkat Kepuasan</div>
                </div>
                <div class="bg-white/80 p-8 rounded-2xl text-center shadow-lg hover:shadow-xl transition-all duration-300">
                    <div class="text-4xl font-bold text-purple-500 mb-2">156</div>
                    <div class="text-gray-600">Survey Aktif</div>
                </div>
                <div class="bg-white/80 p-8 rounded-2xl text-center shadow-lg hover:shadow-xl transition-all duration-300">
                    <div class="text-4xl font-bold text-purple-500 mb-2">6</div>
                    <div class="text-gray-600">Program Studi</div>
                </div>
            </div>

            <div class="bg-white/80 p-8 rounded-2xl text-center shadow-lg hover:shadow-xl transition-all duration-300">
                <h3 class="text-2xl font-bold text-dark-blue mb-6 text-center">Partisipasi per Program Studi</h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-gray-700 font-medium">Teknik Informatika</span>
                        <div class="flex items-center space-x-3">
                            <div class="w-64 bg-gray-200 rounded-full h-3">
                                <div class="bg-medium-blue h-3 rounded-full" style="width: 92%"></div>
                            </div>
                            <span class="text-sm font-semibold text-medium-blue">92%</span>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-700 font-medium">Sistem Informasi</span>
                        <div class="flex items-center space-x-3">
                            <div class="w-64 bg-gray-200 rounded-full h-3">
                                <div class="bg-green-500 h-3 rounded-full" style="width: 89%"></div>
                            </div>
                            <span class="text-sm font-semibold text-green-500">89%</span>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-700 font-medium">Teknik Sipil</span>
                        <div class="flex items-center space-x-3">
                            <div class="w-64 bg-gray-200 rounded-full h-3">
                                <div class="bg-purple-500 h-3 rounded-full" style="width: 87%"></div>
                            </div>
                            <span class="text-sm font-semibold text-purple-500">87%</span>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-700 font-medium">Teknik Elektro</span>
                        <div class="flex items-center space-x-3">
                            <div class="w-64 bg-gray-200 rounded-full h-3">
                                <div class="bg-orange-500 h-3 rounded-full" style="width: 84%"></div>
                            </div>
                            <span class="text-sm font-semibold text-orange-500">84%</span>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-700 font-medium">Teknik Mesin</span>
                        <div class="flex items-center space-x-3">
                            <div class="w-64 bg-gray-200 rounded-full h-3">
                                <div class="bg-blue-500 h-3 rounded-full" style="width: 81%"></div>
                            </div>
                            <span class="text-sm font-semibold text-blue-500">81%</span>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-700 font-medium">Arsitektur</span>
                        <div class="flex items-center space-x-3">
                            <div class="w-64 bg-gray-200 rounded-full h-3">
                                <div class="bg-red-500 h-3 rounded-full" style="width: 78%"></div>
                            </div>
                            <span class="text-sm font-semibold text-red-500">78%</span>
                        </div>
                    </div>
                </div>
            </div>
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
                <button class="bg-white text-dark-blue px-8 py-4 rounded-xl font-semibold text-lg hover:bg-cream transition-all duration-300 transform hover:scale-105">
                    Mulai Survey
                </button>
                <button class="border-2 border-white text-white px-8 py-4 rounded-xl font-semibold text-lg hover:bg-white hover:text-dark-blue transition-all duration-300">
                    Hubungi Kami
                </button>
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
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 bg-medium-blue rounded-full flex items-center justify-center hover:bg-light-blue transition-colors">
                            <span class="text-sm">f</span>
                        </a>
                        <a href="#" class="w-10 h-10 bg-medium-blue rounded-full flex items-center justify-center hover:bg-light-blue transition-colors">
                            <span class="text-sm">t</span>
                        </a>
                        <a href="#" class="w-10 h-10 bg-medium-blue rounded-full flex items-center justify-center hover:bg-light-blue transition-colors">
                            <span class="text-sm">ig</span>
                        </a>
                        <a href="#" class="w-10 h-10 bg-medium-blue rounded-full flex items-center justify-center hover:bg-light-blue transition-colors">
                            <span class="text-sm">yt</span>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h4 class="text-xl font-semibold mb-4">Link Terkait</h4>
                    <ul class="space-y-2 text-blue-200">
                        <li><a href="https://ft.unib.ac.id" class="hover:text-white transition-colors">Website FT UNIB</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Portal Akademik</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">E-Learning</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Perpustakaan Digital</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">SIAKAD</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-xl font-semibold mb-4">Kontak</h4>
                    <div class="space-y-3 text-blue-200">
                        <div class="flex items-start space-x-3">
                            <span class="text-medium-blue mt-1">📍</span>
                            <div>
                                <p>Jl. WR Supratman</p>
                                <p>Kandang Limun, Bengkulu</p>
                                <p>38371</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <span class="text-medium-blue">📧</span>
                            <a href="mailto:ft@unib.ac.id" class="hover:text-white transition-colors">ft@unib.ac.id</a>
                        </div>
                        <div class="flex items-center space-x-3">
                            <span class="text-medium-blue">📞</span>
                            <span>(0736) 344087</span>
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