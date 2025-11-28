<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPULAS - Survey List</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: #ffffff;
            color: #1a1a1a;
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
        }

        .page-container {
            max-width: 1320px;
            margin: 0 auto;
            padding: 0;
            width: 100%;
        }

        /* Header */
        .header {
            margin-bottom: 48px;
        }

        .header-banner {
            background: linear-gradient(135deg, #dbeafe 0%, #fef3c7 100%);
            border-radius: 0 0 24px 24px;
            padding: 48px 40px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
            margin-left: -40px;
            margin-right: -40px;
            padding-left: 80px;
            padding-right: 80px;
        }

        @media (min-width: 1360px) {
            .header-banner {
                margin-left: calc((100vw - 1320px) / -2);
                margin-right: calc((100vw - 1320px) / -2);
            }
        }

        .header-banner::before {
            content: '';
            position: absolute;
            top: -50px;
            right: 10%;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            z-index: 1;
        }

        .header-banner::after {
            content: '';
            position: absolute;
            bottom: -30px;
            left: 15%;
            width: 150px;
            height: 150px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            z-index: 1;
        }

        .header-top {
            display: flex;
            align-items: center;
            gap: 16px;
            position: relative;
            z-index: 2;
        }

        .back-btn {
            width: 40px;
            height: 40px;
            border: 1px solid rgba(255, 255, 255, 0.5);
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 8px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #374151;
            transition: all 0.2s ease;
            flex-shrink: 0;
        }

        .back-btn:hover {
            background: #ffffff;
            border-color: rgba(255, 255, 255, 0.8);
            transform: translateX(-2px);
        }

        .back-btn svg {
            width: 20px;
            height: 20px;
            stroke-width: 2.5;
        }

        .header-content h1 {
            font-size: 32px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 4px;
            letter-spacing: -0.5px;
        }

        .header-content p {
            font-size: 15px;
            color: #4b5563;
            font-weight: 400;
        }

        /* Filter Section */
        .filter-section {
            display: flex;
            gap: 16px;
            margin-bottom: 40px;
            padding: 0 40px;
            align-items: center;
        }

        @media (max-width: 1024px) {
            .filter-section {
                padding: 0 32px;
            }
        }

        @media (max-width: 768px) {
            .filter-section {
                padding: 0 24px;
            }
        }

        @media (max-width: 480px) {
            .filter-section {
                padding: 0 16px;
            }
        }

        .search-wrapper {
            flex: 1;
            min-width: 280px;
            position: relative;
        }

        .search-input {
            width: 100%;
            height: 44px;
            padding: 0 16px 0 44px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            font-size: 15px;
            background: #ffffff;
            transition: all 0.2s ease;
            color: #111827;
        }

        .search-input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.08);
        }

        .search-input::placeholder {
            color: #9ca3af;
        }

        .search-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            width: 20px;
            height: 20px;
            pointer-events: none;
        }

        .filter-group {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #ffffff;
            padding: 0 16px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            height: 44px;
            transition: all 0.2s ease;
        }

        .filter-group:focus-within {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.08);
        }

        .filter-group label {
            font-size: 14px;
            font-weight: 500;
            color: #6b7280;
            white-space: nowrap;
        }

        .filter-select {
            border: none;
            background: transparent;
            font-size: 14px;
            color: #111827;
            cursor: pointer;
            font-weight: 500;
            padding: 0;
            min-width: 140px;
        }

        .filter-select:focus {
            outline: none;
        }

        /* Cards Grid */
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 24px;
            margin-bottom: 48px;
            padding: 0 40px;
        }

        @media (max-width: 1024px) {
            .cards-grid {
                padding: 0 32px;
            }
        }

        @media (max-width: 768px) {
            .cards-grid {
                padding: 0 24px;
            }
        }

        @media (max-width: 480px) {
            .cards-grid {
                padding: 0 16px;
            }
        }

        .card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .card:hover {
            border-color: #d1d5db;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
            transform: translateY(-1px);
        }

        .card-icon-section {
            height: 140px;
            position: relative;
            overflow: hidden;
        }

        .card-image {
            width: 100%;
            height: 140px;
            object-fit: cover;
            display: block;
        }

        .card-body {
            padding: 18px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .card-category {
            font-size: 11px;
            font-weight: 600;
            color: #3b82f6;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            margin-bottom: 8px;
        }

        .card-title {
            font-size: 16px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 6px;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .card-description {
            font-size: 12px;
            color: #6b7280;
            margin-bottom: 16px;
            flex: 1;
            line-height: 1.5;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .card-footer {
            border-top: 1px solid #f3f4f6;
            padding-top: 12px;
        }

        .card-button {
            width: 100%;
            padding: 10px 16px;
            background: #3b82f6;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .card-button:hover {
            background: #2563eb;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .card-button:active {
            transform: translateY(0);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 80px 40px;
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            display: none;
            margin: 0 40px;
        }

        @media (max-width: 1024px) {
            .empty-state {
                margin: 0 32px;
            }
        }

        @media (max-width: 768px) {
            .empty-state {
                margin: 0 24px;
            }
        }

        @media (max-width: 480px) {
            .empty-state {
                margin: 0 16px;
            }
        }

        .empty-icon {
            font-size: 64px;
            margin-bottom: 16px;
            opacity: 0.4;
        }

        .empty-title {
            font-size: 20px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 8px;
        }

        .empty-text {
            font-size: 15px;
            color: #6b7280;
        }

        /* Modal/Popup */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
            z-index: 1000;
            animation: fadeIn 0.2s ease;
        }

        .modal-overlay.active {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-content {
            background: white;
            border-radius: 16px;
            width: 100%;
            max-width: 600px;
            max-height: 90vh;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            animation: slideUp 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .modal-header {
            background: linear-gradient(135deg, #dbeafe 0%, #fef3c7 100%);
            padding: 32px;
            position: relative;
            min-height: 200px;
        }

        .modal-header-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 0;
        }

        .modal-category {
            font-size: 12px;
            font-weight: 600;
            color: #3b82f6;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin: 16px 32px 8px 32px;
            text-align: left;
        }

        .modal-title {
            font-size: 24px;
            font-weight: 700;
            color: #111827;
            margin: 0 32px 8px 32px;
            line-height: 1.3;
            text-align: left;
        }

        .modal-close {
            position: absolute;
            top: 16px;
            right: 16px;
            width: 36px;
            height: 36px;
            border: none;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 8px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #374151;
            transition: all 0.2s ease;
            z-index: 3;
        }

        .modal-close:hover {
            background: white;
            transform: rotate(90deg);
        }

        .modal-close svg {
            width: 20px;
            height: 20px;
            stroke-width: 2.5;
        }

        .modal-icon {
            width: 120px;
            height: 120px;
            margin: 0 auto 16px;
            display: block;
            border-radius: 8px;
            overflow: hidden;
        }

        .modal-icon img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .modal-category {
            font-size: 12px;
            font-weight: 600;
            color: #3b82f6;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: 8px;
        }

        .modal-title {
            font-size: 24px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 8px;
            line-height: 1.3;
        }

        .modal-body {
            padding: 32px;
            overflow-y: auto;
            flex: 1;
        }

        .modal-description {
            font-size: 15px;
            color: #4b5563;
            line-height: 1.6;
            margin-bottom: 16px;
        }

        .modal-info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
            margin-bottom: 24px;
        }

        .modal-info-item {
            padding: 16px;
            background: #f9fafb;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
        }

        .modal-info-label {
            font-size: 12px;
            font-weight: 600;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }

        .modal-info-value {
            font-size: 15px;
            font-weight: 600;
            color: #111827;
        }

        .modal-footer {
            padding: 24px 32px;
            border-top: 1px solid #e5e7eb;
            background: #fafbfc;
            display: flex;
            gap: 12px;
        }

        .modal-button {
            flex: 1;
            padding: 14px 24px;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .modal-button-secondary {
            background: white;
            color: #374151;
            border: 1px solid #d1d5db;
        }

        .modal-button-secondary:hover {
            background: #f9fafb;
            border-color: #9ca3af;
        }

        .modal-button-primary {
            background: #3b82f6;
            color: white;
        }

        .modal-button-primary:hover {
            background: #2563eb;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .modal-button-primary:active {
            transform: translateY(0);
        }

        /* Responsive Modal */
        @media (max-width: 768px) {
            .modal-content {
                max-height: 95vh;
                border-radius: 12px;
            }

            .modal-header {
                padding: 24px;
            }

            .modal-icon {
                font-size: 56px;
                margin-bottom: 12px;
            }

            .modal-title {
                font-size: 22px;
            }

            .modal-body {
                padding: 24px;
            }

            .modal-info-grid {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .modal-footer {
                padding: 20px 24px;
            }
        }

        @media (max-width: 480px) {
            .modal-overlay.active {
                padding: 16px;
            }

            .modal-content {
                border-radius: 12px;
            }

            .modal-header {
                padding: 20px;
            }

            .modal-icon {
                font-size: 48px;
                margin-bottom: 10px;
            }

            .modal-title {
                font-size: 20px;
            }

            .modal-body {
                padding: 20px;
            }

            .modal-description {
                font-size: 14px;
            }

            .modal-footer {
                padding: 16px 20px;
                flex-direction: column-reverse;
            }

            .modal-button {
                width: 100%;
                padding: 12px 20px;
                font-size: 14px;
            }
        }

        /* Stats */
        .stats-bar {
            display: none;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .page-container {
                padding: 0;
            }

            .header {
                padding: 0 32px;
            }

            .header-banner {
                padding: 44px 32px;
            }

            .header-content h1 {
                font-size: 28px;
            }

            .filter-section,
            .cards-grid,
            .empty-state {
                padding-left: 32px;
                padding-right: 32px;
                margin-left: 0;
                margin-right: 0;
            }

            .cards-grid {
                grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
                gap: 20px;
            }
        }

        @media (max-width: 768px) {
            .header {
                padding: 0 24px;
                margin-bottom: 32px;
            }

            .header-banner {
                padding: 36px 24px;
                border-radius: 0 0 20px 20px;
            }

            .header-content h1 {
                font-size: 24px;
            }

            .header-content p {
                font-size: 14px;
            }

            .filter-section {
                flex-direction: column;
                gap: 12px;
                padding: 0 24px;
                margin-bottom: 32px;
            }

            .search-wrapper {
                width: 100%;
                min-width: auto;
            }

            .filter-group {
                width: 100%;
            }

            .cards-grid,
            .empty-state {
                padding-left: 24px;
                padding-right: 24px;
            }

            .cards-grid {
                grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
                gap: 18px;
                margin-bottom: 32px;
            }

            .card-icon-section {
                height: 140px;
                font-size: 48px;
            }

            .card-body {
                padding: 20px;
            }

            .card-title {
                font-size: 17px;
            }

            .card-description {
                font-size: 13px;
            }
        }

        @media (max-width: 480px) {
            .header {
                padding: 0 16px;
                margin-bottom: 24px;
            }

            .header-banner {
                padding: 32px 16px;
                border-radius: 0 0 18px 18px;
            }

            .header-top {
                gap: 12px;
            }

            .header-content h1 {
                font-size: 20px;
            }

            .header-content p {
                font-size: 13px;
            }

            .back-btn {
                width: 36px;
                height: 36px;
            }

            .back-btn svg {
                width: 18px;
                height: 18px;
            }

            .filter-section {
                padding: 0 16px;
                margin-bottom: 24px;
                gap: 10px;
            }

            .search-input,
            .filter-group {
                height: 40px;
            }

            .search-input {
                font-size: 14px;
                padding: 0 14px 0 40px;
            }

            .search-icon {
                width: 18px;
                height: 18px;
                left: 12px;
            }

            .filter-group {
                padding: 0 14px;
            }

            .filter-group label {
                font-size: 13px;
            }

            .filter-select {
                font-size: 13px;
                min-width: 120px;
            }

            .cards-grid,
            .empty-state {
                padding-left: 16px;
                padding-right: 16px;
            }

            .cards-grid {
                grid-template-columns: 1fr;
                gap: 16px;
                margin-bottom: 24px;
            }

            .card-icon-section {
                height: 120px;
                font-size: 44px;
            }

            .card-body {
                padding: 18px;
            }

            .card-category {
                font-size: 11px;
                margin-bottom: 8px;
            }

            .card-title {
                font-size: 16px;
                margin-bottom: 8px;
            }

            .card-description {
                font-size: 13px;
                margin-bottom: 16px;
            }

            .card-button {
                font-size: 13px;
                padding: 10px 16px;
            }

            .empty-state {
                padding: 60px 20px;
            }

            .empty-icon {
                font-size: 52px;
                margin-bottom: 12px;
            }

            .empty-title {
                font-size: 17px;
                margin-bottom: 6px;
            }

            .empty-text {
                font-size: 13px;
            }
        }
    </style>
</head>
<body>
    <div class="page-container">
        <!-- Header -->
        <div class="header">
            <div class="header-banner">
                <div class="header-top">
                    <button class="back-btn" onclick="window.history.back()" title="Kembali">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </button>
                    <div class="header-content">
                        <h1>Daftar Survey</h1>
                        <p>Pilih dan lengkapi survey untuk memberikan masukan Anda</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Bar -->
        <div class="stats-bar"></div>

        <!-- Filters -->
        <div class="filter-section">
            <div class="search-wrapper">
                <svg class="search-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <input type="text" class="search-input" placeholder="Cari survey..." id="searchInput" onkeyup="filterSurveys()">
            </div>
            <div class="filter-group">
                <label for="categoryFilter">Kategori:</label>
                <select class="filter-select" id="categoryFilter" onchange="filterSurveys()">
                    <option value="">Semua Kategori</option>
                    @foreach(\App\Models\Kategori::all() as $kategori)
                    <option value="{{ $kategori->nama }}">{{ $kategori->nama }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Cards Grid -->
        <div class="cards-grid" id="surveysContainer"></div>

        <!-- Empty State -->
        <div class="empty-state" id="emptyState">
            <div class="empty-icon">📋</div>
            <div class="empty-title">Survey tidak ditemukan</div>
            <div class="empty-text">Coba sesuaikan kriteria pencarian atau filter kategori Anda</div>
        </div>

        <!-- Modal/Popup -->
        <div class="modal-overlay" id="modalOverlay" onclick="closeModal(event)">
            <div class="modal-content" onclick="event.stopPropagation()">
                <div class="modal-header">
                    <img src="" alt="Gambar Survey" class="modal-header-image" id="modalImage">
                    <button class="modal-close" onclick="closeModal()" title="Tutup">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="modal-category" id="modalCategory">AKADEMIK</div>
                <div class="modal-title" id="modalTitle">Judul Survey</div>
                <div class="modal-body">
                    <div class="modal-description" id="modalDescription">
                        Deskripsi survey akan muncul di sini.
                    </div>
                    <div class="modal-info-grid">
                        <div class="modal-info-item">
                            <div class="modal-info-label">Jumlah Pertanyaan</div>
                            <div class="modal-info-value" id="modalQuestions">15 pertanyaan</div>
                        </div>
                        <div class="modal-info-item">
                            <div class="modal-info-label">Batas Waktu</div>
                            <div class="modal-info-value" id="modalDeadline">31 Des 2024</div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="modal-button modal-button-secondary" onclick="closeModal()">
                        Batal
                    </button>
                    <button class="modal-button modal-button-primary" onclick="startSurvey()">
                        Isi Sekarang
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Data dari controller Laravel
        const surveys = [
            @foreach($surveys as $survey)
            {
                id: {{ $survey->id_kuesioner }},
                title: "{{ addslashes($survey->nama) }}",
                category: "{{ addslashes($survey->kategori->nama ?? 'umum') }}",
                description: "{{ addslashes($survey->deskripsi) }}",
                sampul: "{{ addslashes($survey->sampul) }}",
                fullDescription: "{{ addslashes($survey->deskripsi) }}",
                duration: '5-10 menit',
                questions: {{ $survey->pertanyaan->count() ?: rand(10, 25) }},
                deadline: "{{ $survey->tanggal_selesai ? $survey->tanggal_selesai->format('j M Y') : 'Tidak ada batas' }}",
                status: 'Belum Diisi'
            }@if(!$loop->last),
            @endif
            @endforeach
        ];

        let currentSurvey = null;

        function escapeHtml(unsafe) {
            if (typeof unsafe !== 'string') {
                return '';
            }
            return unsafe
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;")
                .replace(/'/g, "&#039;");
        }

        function renderSurveys(filtered) {
            const container = document.getElementById('surveysContainer');
            const emptyState = document.getElementById('emptyState');

            if (filtered.length === 0) {
                container.innerHTML = '';
                emptyState.style.display = 'block';
                return;
            }

            emptyState.style.display = 'none';
            var html = '';
            for (var i = 0; i < filtered.length; i++) {
                var survey = filtered[i];
                var description = survey.description.length > 60 ? survey.description.substring(0, 60) + '...' : survey.description;
                var sampulUrl = survey.sampul ? '/storage/' + survey.sampul : '{{ asset("images/gambar1.png") }}';

                html += '<div class="card">' +
                    '<div class="card-icon-section">' +
                        '<img src="' + sampulUrl + '" alt="' + survey.title.replace(/"/g, "&quot;") + '" class="card-image">' +
                    '</div>' +
                    '<div class="card-body">' +
                        '<div class="card-category">' + survey.category.toUpperCase() + '</div>' +
                        '<div class="card-title">' + survey.title + '</div>' +
                        '<div class="card-description">' + description + '</div>' +
                        '<div class="card-footer">' +
                            '<button class="card-button" onclick="handleSurveyClick(' + survey.id + ')">' +
                                'Isi Survey' +
                                '<svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">' +
                                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path>' +
                                '</svg>' +
                            '</button>' +
                        '</div>' +
                    '</div>' +
                '</div>';
            }
            container.innerHTML = html;
        }

        // Handle clicks using a separate function to ensure correct ID is passed
        function handleSurveyClick(surveyId) {
            // Find the survey in the array by ID
            const survey = surveys.find(s => s.id === surveyId);

            if (survey) {
                openModal(survey.id, survey.title, survey.category, survey.fullDescription, survey.duration, survey.questions, survey.deadline);
            }
        }

        function filterSurveys() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const categoryTerm = document.getElementById('categoryFilter').value;

            const filtered = surveys.filter(survey => {
                const matchSearch = survey.title.toLowerCase().includes(searchTerm) ||
                                  survey.description.toLowerCase().includes(searchTerm);
                const matchCategory = categoryTerm === '' || survey.category.toLowerCase() === categoryTerm.toLowerCase();
                return matchSearch && matchCategory;
            });

            renderSurveys(filtered);
        }

        function openModal(id, title, category, fullDescription, duration, questions, deadline) {
            // Simpan informasi survey ke variabel global
            currentSurvey = {
                id: id,
                title: title,
                category: category,
                fullDescription: fullDescription,
                duration: duration,
                questions: questions,
                deadline: deadline,
                status: 'Belum Diisi'
            };

            // Gunakan gambar dari survey atau gambar default untuk modal
            const survey = surveys.find(s => s.id === id);
            if (survey && survey.sampul) {
                document.getElementById('modalImage').src = '/storage/' + survey.sampul;
                document.getElementById('modalImage').alt = title;
            } else {
                document.getElementById('modalImage').src = '{{ asset("images/gambar1.png") }}';
                document.getElementById('modalImage').alt = title;
            }

            document.getElementById('modalCategory').textContent = category.toUpperCase();
            document.getElementById('modalTitle').textContent = title;
            document.getElementById('modalDescription').textContent = fullDescription;
            document.getElementById('modalQuestions').textContent = questions + ' pertanyaan';
            document.getElementById('modalDeadline').textContent = deadline;

            document.getElementById('modalOverlay').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeModal(event) {
            if (event && event.target !== event.currentTarget) return;

            document.getElementById('modalOverlay').classList.remove('active');
            document.body.style.overflow = 'auto';
            currentSurvey = null;
        }

        function startSurvey() {
            if (currentSurvey) {
                // Arahkan ke halaman pengisian survey
                window.location.href = '/isi-survey/' + currentSurvey.id;
                closeModal();
            }
        }

        // Close modal on ESC key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeModal();
            }
        });

        renderSurveys(surveys);
    </script>
</body>
</html>