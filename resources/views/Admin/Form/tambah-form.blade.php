<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPULAS - Buat Form Baru</title>
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
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        }
        .upload-zone {
            transition: all 0.3s ease;
            border: 2px dashed #D1D5DB;
        }
        .upload-zone.dragover {
            border-color: #3B82F6;
            background-color: #F0F9FF;
        }
        .preview-image {
            max-height: 300px;
            object-fit: cover;
            border-radius: 12px;
        }
        .form-input {
            transition: all 0.2s ease;
        }
        .form-input:focus {
            border-color: #3B82F6;
            ring: 2px;
            ring-color: rgba(59, 130, 246, 0.1);
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="flex min-h-screen">
        @include('Admin.navbar')

        <!-- Main Content -->
        <main class="flex-1 lg:ml-72 p-6 lg:p-8">
            <!-- Header -->
            <div class="mb-8">
                <div class="flex items-center space-x-2 mb-2">
                    <a href="#" class="text-sm text-gray-600 hover:text-gray-900">Manajemen Form</a>
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                    <span class="text-sm font-bold text-gray-900 font-medium">Buat Form Baru</span>
                </div>
                <h1 class="text-xl font-bold text-gray-900">Buat Form Baru</h1>
                <p class="text-sm text-gray-600 mt-1">Tambahkan form survey baru ke dalam sistem</p>
            </div>

            <!-- Form Container -->
            <form id="formBaru" class="space-y-6" method="POST" action="{{ route('forms.store') }}" enctype="multipart/form-data">
                @csrf
                <!-- Upload Cover -->
                <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                    <label class="block text-sm font-semibold text-gray-900 mb-3">Unggah Sampul Form</label>
                    <div class="upload-zone rounded-xl p-8 text-center bg-gray-50 flex flex-col items-center justify-center min-h-64 cursor-pointer" id="uploadZone">
                        <input type="file" id="coverInput" name="sampul" accept="image/*" class="hidden" />
                        
                        <div id="uploadPlaceholder" class="space-y-3">
                            <div class="flex justify-center">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Klik untuk unggah atau drag & drop</p>
                                <p class="text-xs text-gray-600 mt-1">Format: PNG, JPG, GIF (maksimal 5MB)</p>
                            </div>
                        </div>

                        <div id="previewContainer" class="hidden w-full">
                            <img id="previewImage" class="preview-image w-full" alt="Preview" />
                            <button type="button" class="mt-3 px-4 py-2 bg-red-500 text-white text-sm font-medium rounded-lg hover:bg-red-600 transition-colors w-full" id="removeImageBtn">
                                Hapus Foto
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Judul Form -->
                <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Judul Form <span class="text-red-500">*</span></label>
                    <input type="text" name="nama"
                        placeholder="Contoh: Survey Kepuasan Layanan Akademik"
                        class="form-input w-full px-4 py-3 border border-gray-200 rounded-xl focus:border-medium-blue focus:ring-2 focus:ring-medium-blue/20 outline-none text-sm transition-all"
                        value="{{ old('nama') }}" required />
                    @error('nama') <p class="text-xs text-red-600 mt-2">{{ $message }}</p> @enderror
                </div>

                <!-- Kategori -->
                <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Kategori <span class="text-red-500">*</span></label>
                    <select name="id_kategori"
                            class="form-input w-full px-4 py-3 border border-gray-200 rounded-xl focus:border-medium-blue focus:ring-2 focus:ring-medium-blue/20 outline-none bg-white text-sm transition-all"
                            required>
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $kat)
                            <option value="{{ $kat->id_kategori }}" @selected(old('id_kategori') == $kat->id_kategori)>{{ $kat->nama }}</option>
                        @endforeach
                    </select>
                    @error('id_kategori') <p class="text-xs text-red-600 mt-2">{{ $message }}</p> @enderror
                </div>

                <!-- Deskripsi -->
                <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Deskripsi</label>
                    <textarea name="deskripsi" rows="5"
                            placeholder="Jelaskan tujuan dan konten form survey ini..."
                            class="form-input w-full px-4 py-3 border border-gray-200 rounded-xl focus:border-medium-blue focus:ring-2 focus:ring-medium-blue/20 outline-none text-sm transition-all resize-none">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi') <p class="text-xs text-red-600 mt-2">{{ $message }}</p> @enderror
                </div>

                <!-- Tanggal Berlaku -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai"
                            class="form-input w-full px-4 py-3 border border-gray-200 rounded-xl focus:border-medium-blue focus:ring-2 focus:ring-medium-blue/20 outline-none text-sm transition-all"
                            value="{{ old('tanggal_mulai') }}" />
                        @error('tanggal_mulai') <p class="text-xs text-red-600 mt-2">{{ $message }}</p> @enderror
                    </div>
                    <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Tanggal Berakhir</label>
                        <input type="date" name="tanggal_selesai"
                            class="form-input w-full px-4 py-3 border border-gray-200 rounded-xl focus:border-medium-blue focus:ring-2 focus:ring-medium-blue/20 outline-none text-sm transition-all"
                            value="{{ old('tanggal_selesai') }}" />
                        @error('tanggal_selesai') <p class="text-xs text-red-600 mt-2">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Status (tidak ada di DB, abaikan dulu)
                    biarkan input radio tanpa name atau hapus dari DOM agar tidak mengganggu -->
                <!-- <input type="radio" ... > -->

                <!-- Buttons -->
                <div class="flex gap-3 pt-4">
                    <a href="{{ url('/form') }}" class="flex-1 px-6 py-3 border border-gray-200 text-gray-900 font-medium rounded-xl hover:bg-gray-50 transition-colors text-sm text-center">
                        Batal
                    </a>
                    <button type="submit" class="flex-1 px-6 py-3 bg-gradient-to-r from-medium-blue to-blue-600 text-white font-medium rounded-xl hover:from-dark-blue hover:to-blue-700 transition-all shadow-sm text-sm flex items-center justify-center space-x-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        <span>Buat Form</span>
                    </button>
                </div>
            </form>
        </main>
    </div>

    <script>
        const uploadZone = document.getElementById('uploadZone');
        const coverInput = document.getElementById('coverInput');
        const uploadPlaceholder = document.getElementById('uploadPlaceholder');
        const previewContainer = document.getElementById('previewContainer');
        const previewImage = document.getElementById('previewImage');
        const removeImageBtn = document.getElementById('removeImageBtn');

        // Click to upload
        uploadZone.addEventListener('click', () => coverInput.click());

        // File input change
        coverInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (file) {
                displayPreview(file);
            }
        });

        // Drag and drop
        uploadZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadZone.classList.add('dragover');
        });

        uploadZone.addEventListener('dragleave', () => {
            uploadZone.classList.remove('dragover');
        });

        uploadZone.addEventListener('drop', (e) => {
            e.preventDefault();
            uploadZone.classList.remove('dragover');
            const file = e.dataTransfer.files[0];
            if (file && file.type.startsWith('image/')) {
                coverInput.files = e.dataTransfer.files;
                displayPreview(file);
            }
        });

        function displayPreview(file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                previewImage.src = e.target.result;
                uploadPlaceholder.classList.add('hidden');
                previewContainer.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }

        removeImageBtn.addEventListener('click', (e) => {
            e.preventDefault();
            showConfirmation(
                "Konfirmasi Penghapusan",
                "Apakah Anda yakin ingin menghapus foto sampul?",
                function() {
                    coverInput.value = '';
                    uploadPlaceholder.classList.remove('hidden');
                    previewContainer.classList.add('hidden');
                    uploadZone.classList.remove('dragover');
                }
            );
        });

        // // Form submission
        // document.getElementById('formBaru').addEventListener('submit', (e) => {
        //     e.preventDefault();
        //     alert('Form akan disimpan! (Demo)');
        // });
    </script>

    @include('partials.confirmation-modal')
</body>
</html>