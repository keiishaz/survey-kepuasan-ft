
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPULAS - Edit Form</title>
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
            width: 100% !important;
            height: auto;
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
            <div class="mb-6">
                <div class="flex items-center space-x-2 mb-2">
                    <a href="{{ route('forms.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Manajemen Form</a>
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                    <span class="text-sm text-gray-900 font-medium">{{ $form->nama ?? 'Form Baru' }}</span>
                </div>
                <h1 class="text-2xl font-bold text-gray-900 mb-1">Edit Form</h1>
                <p class="text-sm text-gray-600">Perbarui informasi form untuk disesuaikan kebutuhan Anda</p>
            </div>

            <!-- Form -->
            <form action="{{ route('forms.update', $form->id_kuesioner) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Upload Cover -->
                <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 mb-6">
                    <label class="block text-sm font-semibold text-gray-900 mb-3">Unggah Sampul Form</label>

                    <div id="uploadZone" class="upload-zone rounded-xl p-8 text-center bg-gray-50 flex flex-col items-center justify-center min-h-64 cursor-pointer group">
                        <input type="file" id="imageUpload" name="sampul" accept="image/*" class="hidden">
                        <input type="hidden" id="removeImageFlag" name="remove_sampul" value="0">

                        <div id="uploadPlaceholder" class="space-y-3">
                            <div class="flex justify-center">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-gray-600 text-sm font-medium">Klik atau seret file ke sini</p>
                                <p class="text-gray-400 text-xs mt-1">Format: PNG, JPG, JPEG, GIF (Max 5MB)</p>
                            </div>
                        </div>

                        <div id="previewContainer" class="hidden w-full">
                            <img id="previewImage" class="preview-image w-full" alt="Preview" />
                            <button type="button" class="mt-3 px-4 py-2 bg-red-500 text-white text-sm font-medium rounded-lg hover:bg-red-600 transition-colors w-full" id="removeImageBtn">
                                Hapus Foto
                            </button>
                        </div>
                    </div>

                    @error('sampul')
                        <p class="text-xs text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nama Form -->
                <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 mb-6">
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Nama Form <span class="text-red-500">*</span></label>
                    <input type="text"
                           name="nama"
                           value="{{ old('nama', $form->nama) }}"
                           required
                           placeholder="Masukkan nama form"
                           class="form-input w-full px-4 py-3 border border-gray-200 rounded-xl focus:border-medium-blue focus:ring-2 focus:ring-medium-blue/20 outline-none text-sm transition-all">
                    @error('nama')
                        <p class="text-xs text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Kategori -->
                <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 mb-6">
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Kategori <span class="text-red-500">*</span></label>
                    <select name="id_kategori" required
                            class="form-input w-full px-4 py-3 border border-gray-200 rounded-xl focus:border-medium-blue focus:ring-2 focus:ring-medium-blue/20 outline-none text-sm transition-all bg-white">
                        <option value="">Pilih kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id_kategori }}"
                                    {{ old('id_kategori', $form->id_kategori) == $category->id_kategori ? 'selected' : '' }}>
                                {{ $category->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_kategori')
                        <p class="text-xs text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 mb-6">
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Deskripsi</label>
                    <textarea
                        name="deskripsi"
                        placeholder="Tambahkan deskripsi untuk memberikan informasi lebih detail"
                        class="form-input w-full px-4 py-3 border border-gray-200 rounded-xl focus:border-medium-blue focus:ring-2 focus:ring-medium-blue/20 outline-none text-sm transition-all resize-none">{{ old('deskripsi', $form->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <p class="text-xs text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tanggal Berlaku -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai"
                            class="form-input w-full px-4 py-3 border border-gray-200 rounded-xl focus:border-medium-blue focus:ring-2 focus:ring-medium-blue/20 outline-none text-sm transition-all"
                            value="{{ old('tanggal_mulai', $form->tanggal_mulai ? $form->tanggal_mulai->format('Y-m-d') : '') }}" />
                        @error('tanggal_mulai')
                            <p class="text-xs text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Tanggal Selesai</label>
                        <input type="date" name="tanggal_selesai"
                            class="form-input w-full px-4 py-3 border border-gray-200 rounded-xl focus:border-medium-blue focus:ring-2 focus:ring-medium-blue/20 outline-none text-sm transition-all"
                            value="{{ old('tanggal_selesai', $form->tanggal_selesai ? $form->tanggal_selesai->format('Y-m-d') : '') }}" />
                        @error('tanggal_selesai')
                            <p class="text-xs text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-8 flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4">
                    <button type="submit" class="px-6 py-3 bg-gradient-to-r from-medium-blue to-blue-600 text-white font-medium rounded-xl text-sm hover:from-dark-blue hover:to-blue-700 transition-all duration-300 shadow-sm hover:shadow-md">
                        Perbarui Form
                    </button>
                    <a href="{{ route('forms.show', $form->id_kuesioner) }}" class="px-6 py-3 bg-gray-100 text-gray-700 font-medium rounded-xl text-sm hover:bg-gray-200 transition-all duration-200 text-center">
                        Batal
                    </a>
                </div>
            </form>
        </main>
    </div>

    <script>
        // Initialize with existing image if available
        @if($form->sampul)
            document.getElementById('previewImage').src = "{{ asset('uploadedfiles/'.$form->sampul) }}";
            document.getElementById('uploadPlaceholder').classList.add('hidden');
            document.getElementById('previewContainer').classList.remove('hidden');
        @endif

        const uploadZone = document.getElementById('uploadZone');
        const imageUpload = document.getElementById('imageUpload');
        const previewContainer = document.getElementById('previewContainer');
        const uploadPlaceholder = document.getElementById('uploadPlaceholder');
        const removeImageBtn = document.getElementById('removeImageBtn');

        // Click to upload
        uploadZone.addEventListener('click', () => imageUpload.click());

        // File input change
        imageUpload.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (file) {
                displayPreview(file);
            }
        });

        function displayPreview(file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                document.getElementById('previewImage').src = e.target.result;
                uploadPlaceholder.classList.add('hidden');
                previewContainer.classList.remove('hidden');
                document.getElementById('removeImageFlag').value = '0'; // Reset remove flag when new image is selected
            };
            reader.readAsDataURL(file);
        }

        removeImageBtn.addEventListener('click', (e) => {
            e.preventDefault();
            showConfirmation(
                "Konfirmasi Penghapusan",
                "Apakah Anda yakin ingin menghapus foto sampul?",
                function() {
                    document.getElementById('removeImageFlag').value = '1';
                    imageUpload.value = '';
                    uploadPlaceholder.classList.remove('hidden');
                    previewContainer.classList.add('hidden');
                    uploadZone.classList.remove('dragover');
                }
            );
        });

        // Drag and drop functionality
        uploadZone.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.classList.add('dragover');
        });

        uploadZone.addEventListener('dragleave', function(e) {
            e.preventDefault();
            this.classList.remove('dragover');
        });

        uploadZone.addEventListener('drop', function(e) {
            e.preventDefault();
            this.classList.remove('dragover');

            const files = e.dataTransfer.files;
            if (files.length) {
                imageUpload.files = files;
                // Trigger change event manually
                const event = new Event('change', { bubbles: true });
                imageUpload.dispatchEvent(event);
            }
        });
    </script>

    @include('partials.confirmation-modal')
</body>
</html>