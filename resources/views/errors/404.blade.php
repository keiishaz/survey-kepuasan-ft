<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan | SIPULAS</title>
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
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #f4f4f4ff;
        }
        .pulse-glow {
            animation: pulseGlow 2s infinite alternate;
        }
        @keyframes pulseGlow {
            0% { box-shadow: 0 0 20px rgba(59, 130, 246, 0.4); }
            100% { box-shadow: 0 0 40px rgba(59, 130, 246, 0.8); }
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full text-center">
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl p-6 border border-white/30">
            <div class="flex justify-center mb-4">
                <div class="w-24 h-24 bg-gradient-to-br from-pastel-blue to-light-blue rounded-full flex items-center justify-center mx-auto pulse-glow">
                    <div class="text-4xl font-bold text-dark-blue">404</div>
                </div>
            </div>

            <h1 class="text-xl md:text-2xl font-bold text-dark-blue mb-3">
                Halaman Tidak Ditemukan
            </h1>

            <p class="text-gray-700 text-sm md:text-base mb-6 leading-relaxed">
                Maaf, halaman yang Anda cari tidak dapat ditemukan.<br>
                Mungkin halaman telah dipindahkan atau tidak tersedia.
            </p>

            <div class="flex flex-col gap-3 justify-center">
                <a href="{{ url('/') }}" class="bg-white text-dark-blue border border-medium-blue px-4 py-2.5 rounded-lg font-medium text-sm hover:bg-medium-blue hover:text-white transition-all duration-300 shadow focus:ring-4 focus:ring-medium-blue/30">
                    <span class="flex items-center justify-center space-x-2">
                        <span>Kembali ke Beranda</span>
                    </span>
                </a>
                <a href="{{ url('/cari-survey') }}" class="bg-medium-blue text-white px-4 py-2.5 rounded-lg font-medium text-sm hover:bg-dark-blue transition-all duration-300 shadow focus:ring-4 focus:ring-medium-blue/30">
                    <span class="flex items-center justify-center space-x-2">
                        <span>Cari Survey</span>
                    </span>
                </a>
            </div>
        </div>

        <div class="mt-6 text-center">
            <p class="text-blue-800/60 text-xs md:text-sm">
                &copy; {{ date('Y') }} SIPULAS - Fakultas Teknik Universitas Bengkulu. Semua hak dilindungi.
            </p>
        </div>
    </div>
</body>
</html>