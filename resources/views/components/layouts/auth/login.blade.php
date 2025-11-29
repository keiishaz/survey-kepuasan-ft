<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
        <style>
            .login-bg {
                background: linear-gradient(135deg, #bae6fd 0%, #fef3c7 100%);
            }
            .btn-primary {
                background: linear-gradient(to right, #2563EB, #3B82F6);
                color: white;
                padding: 0.75rem 1.5rem;
                border-radius: 0.5rem;
                font-weight: 600;
                transition: all 0.3s ease;
                border: none;
                cursor: pointer;
                width: 100%;
                box-shadow: 0 4px 6px rgba(37, 99, 235, 0.2);
            }
            .btn-primary:hover {
                background: linear-gradient(to right, #1D4ED8, #2563EB);
                transform: translateY(-2px);
                box-shadow: 0 6px 8px rgba(37, 99, 235, 0.3);
            }
            .form-input {
                width: 100%;
                padding: 0.75rem;
                border: 2px solid #E2E8F0;
                border-radius: 0.5rem;
                font-size: 1rem;
                transition: all 0.3s ease;
                background-color: #FFFFFF;
                color: #1F2937;
            }
            .form-input:focus {
                outline: none;
                border-color: #2563EB;
                box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.2);
                color: #1F2937;
            }
            .form-input::placeholder {
                color: #9CA3AF;
                opacity: 0.7;
            }
            .form-label {
                display: block;
                margin-bottom: 0.5rem;
                font-weight: 500;
                color: #374151;
            }
        </style>
    </head>
    <body class="min-h-screen antialiased">
        <div class="min-h-screen flex items-center justify-center p-4 login-bg">
            <div class="w-full max-w-4xl bg-white rounded-2xl shadow-2xl overflow-hidden">
                <div class="flex flex-col md:flex-row">
                    <!-- Kolom Kiri - Form Login -->
                    <div class="w-full md:w-1/2 p-10">
                        <!-- Logo dan Header -->
                        <div class="text-center mb-4">
                            <div class="flex justify-center mb-4">
                                <img src="{{ asset('images/logounib.png') }}" alt="Logo UNIB" class="h-16 w-16 object-contain">
                            </div>
                            <h1 class="text-3xl font-bold text-[#1D4ED8]">SIPULAS</h1>
                            <p class="text-[#2563EB] font-medium">Fakultas Teknik Universitas Bengkulu</p>
                        </div>

                        <div class="text-center mb-6">
                            <h2 class="text-2xl font-bold text-gray-800 mb-2">Selamat Datang!</h2>
                            <p class="text-gray-600">Silakan masuk ke akun Anda</p>
                        </div>

                        <!-- Form Login -->
                        <div class="mt-4">
                            {{ $slot }}
                        </div>
                    </div>

                    <!-- Kolom Kanan - Gambar -->
                    <div class="w-full md:w-1/2">
                        <img
                            src="{{ asset('images/FT.jpg') }}"
                            alt="Login Background"
                            class="w-full h-full object-cover"
                        >
                    </div>
                </div>
            </div>
        </div>
        @fluxScripts
    </body>
</html>