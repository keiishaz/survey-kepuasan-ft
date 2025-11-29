<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPULAS - Form Survey</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f4f4f4ff; /* Light grayish-white background */
        }

        .formbold-main-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        .formbold-form-wrapper {
            margin: 0 auto;
            max-width: 1000px; /* Wider container for desktop */
            width: 100%;
            background: white;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
        }

        .formbold-header {
            background: linear-gradient(135deg, #bae6fd 0%, #fef3c7 100%); /* Blue and yellow gradient like before */
            border-radius: 12px 12px 0 0;
            padding: 20px;
            margin-bottom: 20px;
            position: relative;
            overflow: hidden;
            color: #1e293b;
        }

        .formbold-header-content {
            position: relative;
            z-index: 2;
        }

        .formbold-survey-category {
            font-size: 11px;
            font-weight: 600;
            color: #1e293b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
            background: rgba(255, 255, 255, 0.4);
            padding: 4px 10px;
            border-radius: 16px;
            display: inline-block;
        }

        .formbold-header-title {
            font-size: 24px; /* Larger title for better readability */
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 8px;
            letter-spacing: -0.2px;
        }

        .formbold-survey-info {
            position: relative;
            z-index: 2;
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
            margin-top: 16px;
        }

        .formbold-info-item {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            color: #374151;
        }

        .formbold-info-item svg {
            width: 16px; /* Standardize icon size */
            height: 16px;
            color: #1e293b;
        }

        .formbold-section {
            background: white;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 16px;
            border: 1px solid #e2e8f0;
        }

        .formbold-section-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 1px solid #e2e8f0;
        }

        .formbold-section-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            margin-right: 10px;
        }

        .formbold-section-title {
            font-size: 18px; /* Smaller title */
            font-weight: 700;
            color: #1e293b;
            line-height: 1.3;
        }

        .formbold-question-group {
            margin-bottom: 24px;
            padding: 16px;
            background: #f8fafc;
            border-radius: 8px;
            border-left: 2px solid #bae6fd;
        }

        .formbold-question-label {
            font-size: 15px; /* Larger text for better readability */
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 12px;
            display: block;
            line-height: 1.5;
        }

        .formbold-required {
            color: #dc2626;
            margin-left: 4px;
        }

        .formbold-form-input {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 14px;
            background: white;
            transition: all 0.2s ease;
            color: #1e293b;
        }

        .formbold-form-input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .formbold-form-input::placeholder {
            color: #94a3b8;
        }

        .formbold-radio-group {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: flex-start;
            margin-top: 12px;
            flex-wrap: wrap;
        }

        .formbold-radio-label {
            flex: 1;
            text-align: center;
            padding: 0 5px;
            cursor: pointer;
        }

        .formbold-radio-input {
            width: 20px;
            height: 20px;
            margin: 0 auto 6px;
            cursor: pointer;
            display: block;
        }

        .formbold-radio-text {
            font-size: 13px; /* Increased text size */
            color: #374151;
            font-weight: 600;
        }

        .formbold-btn {
            padding: 12px 36px;
            background: #3b82f6;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }

        .formbold-btn:hover {
            background: #2563eb;
            transform: translateY(-1px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .formbold-btn:active {
            transform: translateY(0);
        }

        .formbold-nav-buttons {
            display: flex;
            gap: 12px;
            justify-content: space-between;
            margin-top: 20px;
        }

        .formbold-nav-btn {
            padding: 10px 24px;
            border: 1px solid #cbd5e1;
            background: white;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .formbold-nav-btn:hover {
            background: #f1f5f9;
            border-color: #94a3b8;
        }

        .formbold-nav-btn.next {
            background: #3b82f6;
            color: white;
            border: none;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }

        .formbold-nav-btn.next:hover {
            background: #2563eb;
            transform: translateY(-1px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .formbold-question-counter {
            font-size: 14px;
            color: #374151;
            margin-bottom: 20px;
            padding: 10px 14px;
            background: #f1f5f9;
            border-radius: 8px;
            font-weight: 600;
            border-left: 2px solid #bae6fd;
        }

        .formbold-sub-section-title {
            font-size: 17px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 16px;
            padding-bottom: 8px;
            border-bottom: 1px solid #e2e8f0;
        }

        .formbold-back-btn {
            width: 36px;
            height: 36px;
            border: 2px solid rgba(30, 41, 59, 0.2);
            background: rgba(255, 255, 255, 0.3);
            border-radius: 8px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #1e293b;
            transition: all 0.3s ease;
            flex-shrink: 0;
        }

        .formbold-back-btn:hover {
            background: rgba(255, 255, 255, 0.5);
            border-color: rgba(30, 41, 59, 0.4);
        }

        .formbold-back-btn svg {
            width: 16px;
            height: 16px;
            stroke-width: 2.5;
        }

        @media (max-width: 768px) {
            .formbold-main-wrapper {
                padding: 16px;
            }

            .formbold-form-wrapper {
                padding: 20px;
                max-width: 90%;
            }

            .formbold-header {
                padding: 18px;
            }

            .formbold-header-title {
                font-size: 22px;
            }

            .formbold-survey-info {
                gap: 12px;
            }

            .formbold-section {
                padding: 20px;
            }

            .formbold-section-title {
                font-size: 18px;
            }

            .formbold-question-label {
                font-size: 14px;
            }

            .formbold-radio-group {
                flex-direction: column;
                align-items: center;
                gap: 10px;
            }

            .formbold-radio-label {
                flex: 0 0 100%;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                padding: 10px;
                border: 1px solid #e2e8f0;
                border-radius: 8px;
                margin: 5px 0;
                width: 100%;
            }

            .formbold-back-btn {
                width: 32px;
                height: 32px;
            }

            .formbold-back-btn svg {
                width: 14px;
                height: 14px;
            }
        }

        @media (max-width: 480px) {
            .formbold-main-wrapper {
                padding: 12px;
            }

            .formbold-form-wrapper {
                padding: 16px;
                max-width: 95%;
            }

            .formbold-header {
                padding: 16px;
            }

            .formbold-header-title {
                font-size: 20px;
            }

            .formbold-survey-info {
                flex-direction: column;
                gap: 8px;
            }

            .formbold-info-item {
                font-size: 13px;
                align-items: center;
            }

            .formbold-section {
                padding: 18px;
            }

            .formbold-section-header {
                gap: 10px;
                margin-bottom: 18px;
            }

            .formbold-section-icon {
                font-size: 18px;
            }

            .formbold-section-title {
                font-size: 17px;
            }

            .formbold-question-group {
                margin-bottom: 20px;
                padding: 14px;
            }

            .formbold-question-label {
                font-size: 14px;
                margin-bottom: 10px;
            }

            .formbold-form-input {
                padding: 8px 10px;
                font-size: 14px;
            }

            .formbold-btn,
            .formbold-nav-btn {
                width: 100%;
                padding: 12px 18px;
                font-size: 15px;
            }

            .formbold-question-counter {
                font-size: 13px;
            }
        }

        /* Notification Styles */
        .notification-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 10px;
            max-width: 350px;
        }

        .notification {
            display: flex;
            align-items: center;
            padding: 16px 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
            color: white;
            font-size: 14px;
            font-weight: 500;
            position: relative;
            overflow: hidden;
            animation: slideInRight 0.3s ease-out;
        }

        .notification.error {
            background: linear-gradient(135deg, #f87171, #ef4444);
            border-left: 4px solid #dc2626;
        }

        .notification-close {
            position: absolute;
            top: 10px;
            right: 10px;
            background: transparent;
            border: none;
            color: white;
            font-size: 18px;
            cursor: pointer;
            padding: 2px;
        }

        .notification-icon {
            margin-right: 10px;
            font-size: 18px;
        }

        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
            }
            to {
                opacity: 0;
            }
        }
    </style>
</head>
<body>
    <!-- Notification Container -->
    <div class="notification-container" id="notificationContainer"></div>

    <div class="formbold-main-wrapper">
        <div class="formbold-form-wrapper">
            <!-- Header -->
            <div class="formbold-header">
                <div class="flex justify-between items-start">
                    <div class="formbold-back-btn" onclick="window.history.back()" title="Kembali">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </div>
                    <div class="flex-grow ml-4">
                        <div class="formbold-header-content">
                            <div class="formbold-survey-category">{{ $survey->kategori->nama ?? 'UMUM' }}</div>
                            <h1 class="formbold-header-title">{{ $survey->nama }}</h1>
                        </div>
                        <div class="formbold-survey-info mt-4">
                            <div class="formbold-info-item">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                                <span>{{ $survey->pertanyaan->count() }} pertanyaan</span>
                            </div>
                            <div class="formbold-info-item">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span>
                                    @if($survey->tanggal_selesai)
                                        Batas: {{ $survey->tanggal_selesai->format('j M Y') }}
                                    @else
                                        Batas: Tidak ada
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <form id="surveyForm" method="POST" action="{{ route('isi-survey.store', $survey->id_kuesioner) }}">
                @csrf
                <!-- Hidden inputs to maintain all answers across sections -->
                <div id="hidden-answers-container"></div>

                <!-- Identitas Section - Always visible but shown first -->
                <div id="identitas-section" class="formbold-section">
                    <div class="formbold-section-header">
                        <div class="formbold-section-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 20 20" width="20" height="20" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <h3 class="formbold-section-title">Identitas</h3>
                    </div>

                    @if($survey->identitas)
                        @if($survey->identitas->wajib1 || $survey->identitas->atribut1)
                        <div class="formbold-question-group">
                            <label class="formbold-question-label">
                                {{ $survey->identitas->atribut1 }}{!! $survey->identitas->wajib1 ? '<span class="formbold-required">*</span>' : '' !!}
                            </label>
                            <input type="text" class="formbold-form-input" id="identitas1" name="identitas1" value="{{ old('identitas1', session('identitas1', '')) }}" placeholder="Masukkan {{ strtolower($survey->identitas->atribut1) }}" {!! $survey->identitas->wajib1 ? 'required' : '' !!}>
                        </div>
                        @endif

                        @if($survey->identitas->wajib2 || $survey->identitas->atribut2)
                        <div class="formbold-question-group">
                            <label class="formbold-question-label">
                                {{ $survey->identitas->atribut2 }}{!! $survey->identitas->wajib2 ? '<span class="formbold-required">*</span>' : '' !!}
                            </label>
                            <input type="text" class="formbold-form-input" id="identitas2" name="identitas2" value="{{ old('identitas2', session('identitas2', '')) }}" placeholder="Masukkan {{ strtolower($survey->identitas->atribut2) }}" {!! $survey->identitas->wajib2 ? 'required' : '' !!}>
                        </div>
                        @endif

                        @if($survey->identitas->wajib3 || $survey->identitas->atribut3)
                        <div class="formbold-question-group">
                            <label class="formbold-question-label">
                                {{ $survey->identitas->atribut3 }}{!! $survey->identitas->wajib3 ? '<span class="formbold-required">*</span>' : '' !!}
                            </label>
                            <input type="text" class="formbold-form-input" id="identitas3" name="identitas3" value="{{ old('identitas3', session('identitas3', '')) }}" placeholder="Masukkan {{ strtolower($survey->identitas->atribut3) }}" {!! $survey->identitas->wajib3 ? 'required' : '' !!}>
                        </div>
                        @endif

                        @if($survey->identitas->wajib4 || $survey->identitas->atribut4)
                        <div class="formbold-question-group">
                            <label class="formbold-question-label">
                                {{ $survey->identitas->atribut4 }}{!! $survey->identitas->wajib4 ? '<span class="formbold-required">*</span>' : '' !!}
                            </label>
                            <input type="text" class="formbold-form-input" id="identitas4" name="identitas4" value="{{ old('identitas4', session('identitas4', '')) }}" placeholder="Masukkan {{ strtolower($survey->identitas->atribut4) }}" {!! $survey->identitas->wajib4 ? 'required' : '' !!}>
                        </div>
                        @endif

                        @if($survey->identitas->wajib5 || $survey->identitas->atribut5)
                        <div class="formbold-question-group">
                            <label class="formbold-question-label">
                                {{ $survey->identitas->atribut5 }}{!! $survey->identitas->wajib5 ? '<span class="formbold-required">*</span>' : '' !!}
                            </label>
                            <input type="text" class="formbold-form-input" id="identitas5" name="identitas5" value="{{ old('identitas5', session('identitas5', '')) }}" placeholder="Masukkan {{ strtolower($survey->identitas->atribut5) }}" {!! $survey->identitas->wajib5 ? 'required' : '' !!}>
                        </div>
                        @endif
                    @else
                        <!-- Default identitas fields jika tidak ada konfigurasi -->
                        <div class="formbold-question-group">
                            <label class="formbold-question-label">
                                Nama Lengkap<span class="formbold-required">*</span>
                            </label>
                            <input type="text" class="formbold-form-input" id="identitas1" name="identitas1" value="{{ old('identitas1', session('identitas1', '')) }}" placeholder="Masukkan nama lengkap Anda" required>
                        </div>

                        <div class="formbold-question-group">
                            <label class="formbold-question-label">
                                Email<span class="formbold-required">*</span>
                            </label>
                            <input type="email" class="formbold-form-input" id="identitas2" name="identitas2" value="{{ old('identitas2', session('identitas2', '')) }}" placeholder="nama@email.com" required>
                        </div>

                        <div class="formbold-question-group">
                            <label class="formbold-question-label">
                                Program Studi<span class="formbold-required">*</span>
                            </label>
                            <input type="text" class="formbold-form-input" id="identitas3" name="identitas3" value="{{ old('identitas3', session('identitas3', '')) }}" placeholder="Masukkan program studi Anda" required>
                        </div>
                    @endif

                    <!-- Next button for identitas -->
                    <div class="formbold-nav-buttons">
                        <button type="button" class="formbold-nav-btn" disabled style="visibility: hidden;">Sebelumnya</button>
                        <button type="button" class="formbold-nav-btn next" onclick="saveCurrentDataAndShowPage(1)">Berikutnya</button>
                    </div>
                </div>

                <!-- Questions Section - hidden initially -->
                <div id="questions-section" class="formbold-section" style="display: none;">
                    <div class="formbold-section-header">
                        <div class="formbold-section-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 20 20" width="20" height="20" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h2 class="formbold-section-title">Pertanyaan Survey</h2>
                    </div>

                    <div class="formbold-question-counter">
                        <span id="current-section">1</span> dari <span id="total-sections">1</span> Bagian
                    </div>

                    <!-- Question groups organized by sub sections -->
                    <div id="questions-container">
                        <!-- Questions will be loaded dynamically -->
                    </div>

                    <!-- Navigation for questions -->
                    <div class="formbold-nav-buttons">
                        <button type="button" class="formbold-nav-btn" id="prev-btn" onclick="goToPreviousSection()">Sebelumnya</button>
                        <button type="button" class="formbold-nav-btn next" id="next-btn" onclick="goToNextSection()">Berikutnya</button>
                    </div>
                </div>

                <!-- Submit Section - hidden initially -->
                <div id="submit-section" class="formbold-section" style="display: none;">
                    <div class="formbold-section-header">
                        <div class="formbold-section-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 20 20" width="20" height="20" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h2 class="formbold-section-title">Selesai</h2>
                    </div>
                    <p class="mb-6 text-center text-lg">Terima kasih telah mengisi survey kami!</p>
                    <button type="submit" class="formbold-btn w-full">Kirim Jawaban</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Get the questions data grouped by section from Laravel
        const sections = [
            @foreach($questionsGrouped as $sectionName => $questionsInSection)
            {
                id: {{ $loop->index + 1 }},
                title: "{{ addslashes($sectionName) }}",
                questions: [
                    @foreach($questionsInSection as $index => $question)
                    {
                        id: {{ $question->id_pertanyaan }},
                        text: "{{ addslashes($question->teks) }}",
                        index: {{ $index }}
                    }@if(!$loop->last),
                    @endif
                    @endforeach
                ]
            }@if(!$loop->last),
            @endif
            @endforeach
        ];

        let currentPage = 0;
        let totalSections = sections.length;
        let allAnswers = {}; // Store all answers across sections

        // Initialize answers from hidden inputs if they exist
        window.addEventListener('DOMContentLoaded', function() {
            // Load any existing hidden answer inputs to allAnswers object
            const hiddenContainer = document.getElementById('hidden-answers-container');
            const hiddenInputs = hiddenContainer.querySelectorAll('input[type="hidden"]');

            for (let i = 0; i < hiddenInputs.length; i++) {
                const input = hiddenInputs[i];
                if (input.name.startsWith('jawaban[')) {
                    const questionId = input.name.match(/jawaban\[(\d+)\]/)[1];
                    if (questionId) {
                        allAnswers[questionId] = input.value;
                    }
                }
            }
        });

        // Function to show a specific page
        function showPage(pageNum) {
            // Hide all sections
            document.getElementById('identitas-section').style.display = 'none';
            document.getElementById('questions-section').style.display = 'none';
            document.getElementById('submit-section').style.display = 'none';

            if (pageNum === 0) {
                // Show identitas section
                document.getElementById('identitas-section').style.display = 'block';
            } else if (pageNum === -1) {
                // Show submit section
                document.getElementById('submit-section').style.display = 'block';
            } else {
                // Show questions section
                document.getElementById('questions-section').style.display = 'block';

                // Update current page (section)
                currentPage = pageNum - 1; // Adjust for 0-based indexing

                // Update section counter
                document.getElementById('current-section').textContent = currentPage + 1;
                document.getElementById('total-sections').textContent = totalSections;

                // Generate and display questions for this section
                renderSection();

                // Update navigation buttons
                document.getElementById('prev-btn').disabled = false;

                // If this is the last section, change next button to Submit
                if (currentPage === totalSections - 1) {
                    document.getElementById('next-btn').textContent = 'Kirim Jawaban';
                    document.getElementById('next-btn').onclick = function() {
                        saveAllCurrentAnswers(); // Save all answers before submit

                        // Show confirmation before submitting
                        showConfirmation(
                            "Konfirmasi Pengiriman",
                            "Apakah Anda yakin ingin mengirim jawaban survey? Jawaban yang dikirim tidak dapat diubah kembali.",
                            function() {
                                document.getElementById('surveyForm').submit(); // Submit the form directly
                            }
                        );
                    };
                } else {
                    document.getElementById('next-btn').textContent = 'Berikutnya';
                    document.getElementById('next-btn').onclick = function() {
                        goToNextSection();
                    };
                }
            }
        }

        function renderSection() {
            const container = document.getElementById('questions-container');

            // Get current section
            const section = sections[currentPage];

            let html = '';

            // Add section title if there's more than one section
            if (totalSections > 1) {
                html += `<h3 class="formbold-sub-section-title">${section.title}</h3>`;
            }

            // Add each question in the section
            section.questions.forEach((question, index) => {
                const questionNumber = (currentPage * 10) + index + 1; // Calculate actual question number

                // Get previously saved answer if exists
                let savedAnswer = allAnswers[question.id] || '';

                // Set default answer to 3 if no previous answer exists
                if (!savedAnswer) {
                    savedAnswer = '3';
                    allAnswers[question.id] = '3';
                    updateHiddenAnswerInput(question.id, '3');
                }

                html += `
                    <div class="formbold-question-group">
                        <label class="formbold-question-label">
                            ${questionNumber}. ${question.text}
                        </label>
                        <div class="formbold-radio-group">
                            <label class="formbold-radio-label">
                                <input type="radio" name="jawaban[${question.id}]" value="1" class="formbold-radio-input" ${savedAnswer === '1' ? 'checked' : ''}>
                                <span class="formbold-radio-text">1<br>Sangat Buruk</span>
                            </label>
                            <label class="formbold-radio-label">
                                <input type="radio" name="jawaban[${question.id}]" value="2" class="formbold-radio-input" ${savedAnswer === '2' ? 'checked' : ''}>
                                <span class="formbold-radio-text">2<br>Buruk</span>
                            </label>
                            <label class="formbold-radio-label">
                                <input type="radio" name="jawaban[${question.id}]" value="3" class="formbold-radio-input" ${savedAnswer === '3' ? 'checked' : ''}>
                                <span class="formbold-radio-text">3<br>Cukup</span>
                            </label>
                            <label class="formbold-radio-label">
                                <input type="radio" name="jawaban[${question.id}]" value="4" class="formbold-radio-input" ${savedAnswer === '4' ? 'checked' : ''}>
                                <span class="formbold-radio-text">4<br>Baik</span>
                            </label>
                            <label class="formbold-radio-label">
                                <input type="radio" name="jawaban[${question.id}]" value="5" class="formbold-radio-input" ${savedAnswer === '5' ? 'checked' : ''}>
                                <span class="formbold-radio-text">5<br>Sangat Baik</span>
                            </label>
                        </div>
                    </div>
                `;
            });

            container.innerHTML = html;

            // Add event listeners to radio buttons to save answers in real time
            const radios = container.querySelectorAll('input[name^="jawaban"]');
            radios.forEach(radio => {
                radio.addEventListener('change', function() {
                    const questionId = this.name.match(/jawaban\[(\d+)\]/)[1];
                    allAnswers[questionId] = this.value;

                    // Update hidden input
                    updateHiddenAnswerInput(questionId, this.value);
                });
            });
        }

        // Function to update/create hidden input for an answer
        function updateHiddenAnswerInput(questionId, value) {
            const hiddenContainer = document.getElementById('hidden-answers-container');
            let hiddenInput = document.querySelector(`input[name="jawaban[${questionId}]"]`);

            if (!hiddenInput) {
                hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = `jawaban[${questionId}]`;
                hiddenContainer.appendChild(hiddenInput);
            }

            hiddenInput.value = value;
        }

        // Function to save all current answers to allAnswers object and hidden inputs
        function saveAllCurrentAnswers() {
            // Save answers that are currently in the DOM
            const radios = document.querySelectorAll('input[name^="jawaban"]');
            radios.forEach(radio => {
                if (radio.checked) {
                    const questionId = radio.name.match(/jawaban\[(\d+)\]/)[1];
                    if (questionId) {
                        allAnswers[questionId] = radio.value;
                        // Update hidden input
                        updateHiddenAnswerInput(questionId, radio.value);
                    }
                }
            });

            // Also ensure all answers in the allAnswers object exist as hidden inputs
            for (const questionId in allAnswers) {
                updateHiddenAnswerInput(questionId, allAnswers[questionId]);
            }

            // Save identity fields to hidden inputs as well
            const identitasFieldNames = ['identitas1', 'identitas2', 'identitas3', 'identitas4', 'identitas5'];
            identitasFieldNames.forEach(fieldName => {
                const identitasField = document.getElementById(fieldName);
                if (identitasField) {
                    updateHiddenIdentitasInput(fieldName, identitasField.value);
                }
            });
        }

        // Handle form submission to ensure all answers are saved
        document.getElementById('surveyForm').addEventListener('submit', function(e) {
            saveAllCurrentAnswers(); // Make sure all answers are saved before form submission
        });

        // Function to go to next section
        function goToNextSection() {
            saveAllCurrentAnswers(); // Save all answers before navigating
            if (currentPage < totalSections - 1) {
                showPage(currentPage + 2); // +2 because 0 is identitas, then +1 for 1-based indexing
            } else {
                // Last section - show submit page
                showPage(-1);
            }
        }

        // Function to go to previous section
        function goToPreviousSection() {
            saveAllCurrentAnswers(); // Save all answers before navigating
            if (currentPage > 0) {
                showPage(currentPage); // +1 for 1-based indexing
            } else {
                // Go back to identitas page
                showPage(0);
            }
        }

        // Function to validate identity uniqueness
        async function validateIdentity(idKuesioner) {
            // Collect active identity values
            const activeIdentities = [];
            const identityFields = ['identitas1', 'identitas2', 'identitas3', 'identitas4', 'identitas5'];

            identityFields.forEach(fieldId => {
                const field = document.getElementById(fieldId);
                if (field && field.value.trim() !== '') {
                    activeIdentities.push({
                        field: fieldId,
                        value: field.value.trim()
                    });
                }
            });

            // If no identities are filled, no validation needed
            if (activeIdentities.length === 0) {
                return { status: 'ok' };
            }

            try {
                const response = await fetch(`/isi-survey/${idKuesioner}/check-duplicate`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        identities: activeIdentities
                    })
                });

                const result = await response.json();
                return result;
            } catch (error) {
                console.error('Error validating identity:', error);
                // In case of error, allow proceeding to avoid blocking user
                return { status: 'ok' };
            }
        }

        // Function to validate required identity fields
        function validateRequiredIdentityFields() {
            // Get the survey configuration for required identity fields
            const requiredFields = [
                @if(isset($survey->identitas) && $survey->identitas->wajib1)
                    { field: 'identitas1', label: '{{ $survey->identitas->atribut1 }}', isRequired: true },
                @endif
                @if(isset($survey->identitas) && $survey->identitas->wajib2)
                    { field: 'identitas2', label: '{{ $survey->identitas->atribut2 }}', isRequired: true },
                @endif
                @if(isset($survey->identitas) && $survey->identitas->wajib3)
                    { field: 'identitas3', label: '{{ $survey->identitas->atribut3 }}', isRequired: true },
                @endif
                @if(isset($survey->identitas) && $survey->identitas->wajib4)
                    { field: 'identitas4', label: '{{ $survey->identitas->atribut4 }}', isRequired: true },
                @endif
                @if(isset($survey->identitas) && $survey->identitas->wajib5)
                    { field: 'identitas5', label: '{{ $survey->identitas->atribut5 }}', isRequired: true },
                @endif
            ];

            let hasErrors = false;
            const errorMessages = [];

            // Clear any existing error indicators
            clearFieldErrors();

            // Validate each required field
            requiredFields.forEach(reqField => {
                const fieldElement = document.getElementById(reqField.field);
                if (fieldElement && reqField.isRequired) {
                    const value = fieldElement.value.trim();

                    if (value === '') {
                        hasErrors = true;

                        // Add visual error indicator to the field
                        fieldElement.classList.add('border-red-500', 'bg-red-50');
                        fieldElement.classList.remove('border-gray-300');

                        // Add error message
                        errorMessages.push(`${reqField.label} wajib diisi.`);
                    }
                }
            });

            if (hasErrors) {
                // Show error notifications for all missing required fields
                errorMessages.forEach(msg => {
                    showNotification('error', msg, 5000);
                });
                return false; // Validation failed
            }

            return true; // All validations passed
        }

        // Function to clear field error styles
        function clearFieldErrors() {
            const allIdentitasFields = ['identitas1', 'identitas2', 'identitas3', 'identitas4', 'identitas5'];
            allIdentitasFields.forEach(fieldName => {
                const field = document.getElementById(fieldName);
                if (field) {
                    field.classList.remove('border-red-500', 'bg-red-50');
                    field.classList.add('border-gray-300');
                }
            });
        }

        // Function to save current data and show next page
        async function saveCurrentDataAndShowPage(pageNum) {
            // Check if moving from identity page to questions page
            if (pageNum === 1) { // Moving from identity page (pageNum 0) to first question page (pageNum 1)
                // First validate required fields
                const requiredValid = validateRequiredIdentityFields();
                if (!requiredValid) {
                    return; // Stop execution if required fields are not filled
                }

                // Then validate identity uniqueness
                const idKuesioner = {{ $survey->id_kuesioner }};

                const validationResult = await validateIdentity(idKuesioner);

                if (validationResult.status === 'duplicate') {
                    // Show custom error notification
                    showNotification('error', validationResult.message || 'Identitas ini sudah pernah digunakan untuk mengisi survey ini.', 5000);
                    return; // Stop execution, do not proceed
                }
            }

            // If validation passed or not on identity page, save identitas data to hidden inputs
            const identitasFieldNames = ['identitas1', 'identitas2', 'identitas3', 'identitas4', 'identitas5'];
            identitasFieldNames.forEach(fieldName => {
                const identitasField = document.getElementById(fieldName);
                if (identitasField) {
                    updateHiddenIdentitasInput(fieldName, identitasField.value);
                }
            });

            showPage(pageNum);
        }

        // Function to update/create hidden input for identitas
        function updateHiddenIdentitasInput(fieldName, value) {
            const hiddenContainer = document.getElementById('hidden-answers-container');
            let hiddenInput = document.querySelector(`input[name="${fieldName}"]`);

            if (!hiddenInput) {
                hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = fieldName;
                hiddenContainer.appendChild(hiddenInput);
            }

            hiddenInput.value = value;
        }

        // Initialize the form - show identitas page first
        showPage(0);

        // Function to show custom notification
        function showNotification(type, message, duration = 5000) {
            const container = document.getElementById('notificationContainer');

            // Create notification element
            const notification = document.createElement('div');
            notification.className = `notification ${type}`;

            // Add close button
            const closeBtn = document.createElement('button');
            closeBtn.className = 'notification-close';
            closeBtn.innerHTML = '&times;';
            closeBtn.onclick = function() {
                closeNotification(notification);
            };

            // Add icon
            const iconSpan = document.createElement('span');
            iconSpan.className = 'notification-icon';
            if (type === 'error') {
                iconSpan.innerHTML = '⚠️'; // Warning icon for error
            }

            // Add message
            const messageSpan = document.createElement('span');
            messageSpan.textContent = message;

            notification.appendChild(iconSpan);
            notification.appendChild(messageSpan);
            notification.appendChild(closeBtn);

            // Add to container
            container.appendChild(notification);

            // Auto remove after duration
            setTimeout(() => {
                closeNotification(notification);
            }, duration);
        }

        // Function to close notification with animation
        function closeNotification(notification) {
            notification.style.animation = 'fadeOut 0.3s ease-out forwards';
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.parentNode.removeChild(notification);
                }
            }, 300);
        }
    </script>

    <!-- Include the confirmation modal -->
    <!-- Universal Confirmation Modal -->
    <div id="confirmationModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-30 transition-opacity backdrop-blur-sm" aria-hidden="true"></div>
        <div class="flex min-h-full items-center justify-center p-4">
            <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-md">
                <div class="bg-white px-6 pt-6 pb-4 sm:pb-6">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-12 sm:w-12">
                            <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                        </div>
                        <div class="mt-4 text-center sm:mt-0 sm:text-left w-full">
                            <h3 class="text-lg font-bold leading-6 text-gray-900" id="modalTitle">Konfirmasi Tindakan</h3>
                            <div class="mt-3">
                                <p class="text-sm text-gray-600" id="modalMessage">Apakah Anda yakin ingin melakukan tindakan ini?</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col-reverse sm:flex-row sm:justify-end sm:space-x-3 bg-gray-50 px-6 py-4 sm:py-5">
                    <button type="button" id="cancelButton" class="mt-2 sm:mt-0 px-5 py-2.5 rounded-lg border border-gray-300 text-gray-700 font-medium text-sm hover:bg-gray-100 transition-colors sm:px-4">
                        Batal
                    </button>
                    <button type="button" id="confirmButton" class="px-5 py-2.5 rounded-lg bg-gradient-to-r from-red-500 to-red-600 text-white font-medium text-sm hover:from-red-600 hover:to-red-700 transition-all shadow-sm sm:px-4">
                        Ya, Lanjutkan
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Universal confirmation function
        function showConfirmation(title, message, onConfirm) {
            document.getElementById('modalTitle').textContent = title;
            document.getElementById('modalMessage').innerHTML = message;
            document.getElementById('confirmationModal').classList.remove('hidden');

            // Apply overflow hidden to prevent background scrolling
            document.body.classList.add('overflow-hidden');

            // Set the callback function
            window.currentConfirmCallback = onConfirm;
        }

        function hideConfirmation() {
            document.getElementById('confirmationModal').classList.add('hidden');

            // Remove overflow hidden
            document.body.classList.remove('overflow-hidden');
        }

        // Event listeners for confirmation modal
        document.getElementById('confirmButton').addEventListener('click', function() {
            if (typeof window.currentConfirmCallback === 'function') {
                window.currentConfirmCallback();
            }
            hideConfirmation();
        });

        document.getElementById('cancelButton').addEventListener('click', hideConfirmation);

        // Close modal when clicking outside the modal content
        document.getElementById('confirmationModal').addEventListener('click', function(e) {
            if (e.target === this) {
                hideConfirmation();
            }
        });

        // Add CSRF token meta tag if not present
        if (!document.querySelector('meta[name="csrf-token"]')) {
            const meta = document.createElement('meta');
            meta.name = 'csrf-token';
            meta.content = document.querySelector('input[name="_token"]').value;
            document.head.appendChild(meta);
        }
    </script>
</body>
</html>