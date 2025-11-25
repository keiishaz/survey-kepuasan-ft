<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-gradient-to-br from-pastel-blue to-cream antialiased">
        <div class="min-h-screen flex items-center justify-center p-4">
            <div class="w-full max-w-md">
                <!-- Logo dan Header -->
                <div class="text-center mb-8">
                    <div class="flex justify-center mb-4">
                        <img src="{{ asset('images/logounib.png') }}" alt="Logo UNIB" class="h-16 w-16 object-contain">
                    </div>
                    <h1 class="text-3xl font-bold text-dark-blue">SIPULAS</h1>
                    <p class="text-medium-blue">Fakultas Teknik Universitas Bengkulu</p>
                </div>

                <!-- Card Login -->
                <div class="bg-white rounded-2xl shadow-xl p-8 border border-pastel-blue/50">
                    {{ $slot }}
                </div>

                <!-- Footer -->
                <div class="text-center mt-6 text-sm text-gray-600">
                    <p>&copy; 2025 SIPULAS - Fakultas Teknik UNIB. All rights reserved.</p>
                </div>
            </div>
        </div>
        @fluxScripts
    </body>
</html>