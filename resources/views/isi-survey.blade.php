<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPULAS - Form Survey</title>
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
            max-width: 900px;
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

        @media (min-width: 940px) {
            .header-banner {
                margin-left: calc((100vw - 900px) / -2);
                margin-right: calc((100vw - 900px) / -2);
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

        .header-top {
            display: flex;
            align-items: center;
            gap: 16px;
            position: relative;
            z-index: 2;
            margin-bottom: 24px;
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

        .header-content {
            position: relative;
            z-index: 2;
        }

        .survey-category {
            font-size: 12px;
            font-weight: 600;
            color: #3b82f6;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: 8px;
        }

        .header-content h1 {
            font-size: 32px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }

        .header-content p {
            font-size: 15px;
            color: #4b5563;
            font-weight: 400;
        }

        .survey-info {
            position: relative;
            z-index: 2;
            display: flex;
            gap: 24px;
            flex-wrap: wrap;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            color: #374151;
        }

        .info-item svg {
            width: 18px;
            height: 18px;
            color: #6b7280;
        }

        /* Form Container */
        .form-container {
            padding: 0 40px 48px;
        }

        /* Section */
        .form-section {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            padding: 32px;
            margin-bottom: 24px;
        }

        .section-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 24px;
        }

        .section-icon {
            width: 40px;
            height: 40px;
            background: white;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            border: 1px solid #e5e7eb;
        }

        .section-title {
            font-size: 20px;
            font-weight: 600;
            color: #111827;
        }

        /* Question */
        .question-group {
            margin-bottom: 32px;
        }

        .question-group:last-child {
            margin-bottom: 0;
        }

        .question-label {
            font-size: 15px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 12px;
            display: block;
        }

        .required {
            color: #ef4444;
            margin-left: 4px;
        }

        /* Input Field */
        .input-field {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 15px;
            background: white;
            transition: all 0.2s ease;
            color: #111827;
        }

        .input-field:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.08);
        }

        .input-field::placeholder {
            color: #9ca3af;
        }

        /* Submit Button */
        .submit-section {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            padding: 32px;
            text-align: center;
        }

        .submit-button {
            padding: 14px 32px;
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
            gap: 8px;
        }

        .submit-button:hover {
            background: #2563eb;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .submit-button:active {
            transform: translateY(0);
        }

        /* Radio button styles for scale */
        .scale-container {
            margin-top: 16px;
        }

        .scale-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 12px 0;
            position: relative;
        }

        .scale-labels {
            display: flex;
            justify-content: space-between;
            width: 100%;
            margin-top: 8px;
            font-size: 13px;
            color: #6b7280;
        }

        .scale-option {
            position: relative;
        }

        .scale-input {
            width: 36px;
            height: 36px;
            border: 2px solid #d1d5db;
            border-radius: 50%;
            background: white;
            cursor: pointer;
            appearance: none;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            position: relative;
        }

        .scale-input:hover {
            border-color: #9ca3af;
            background: #f3f4f6;
        }

        .scale-input:checked {
            border-color: #3b82f6;
            background: #3b82f6;
        }

        .scale-input:checked::after {
            content: '';
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: white;
        }

        .rating-label {
            position: absolute;
            top: -20px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 12px;
            color: #6b7280;
            white-space: nowrap;
        }

        .radio-group {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .radio-group label {
            flex: 1;
            text-align: center;
            padding: 0 5px;
        }

        .radio-group input[type="radio"] {
            width: 24px;
            height: 24px;
            margin: 0 auto 8px;
            cursor: pointer;
        }

        .radio-group small {
            font-size: 12px;
            color: #6b7280;
        }

        /* Navigation */
        .nav-buttons {
            display: flex;
            gap: 12px;
            justify-content: space-between;
            margin-top: 24px;
        }

        .nav-btn {
            padding: 12px 24px;
            border: 1px solid #d1d5db;
            background: white;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .nav-btn:hover {
            background: #f3f4f6;
            border-color: #9ca3af;
        }

        .nav-btn.next {
            background: #3b82f6;
            color: white;
            border-color: #3b82f6;
        }

        .nav-btn.next:hover {
            background: #2563eb;
            border-color: #2563eb;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .page-indicator {
            text-align: center;
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 16px;
        }

        /* Question counter */
        .question-counter {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 16px;
        }

        /* Section Title */
        .sub-section-title {
            font-size: 18px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 16px;
            padding-bottom: 8px;
            border-bottom: 1px solid #e5e7eb;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .page-container {
                padding: 0 24px;
            }

            .header {
                margin-bottom: 32px;
            }

            .header-banner {
                padding: 36px 24px;
                border-radius: 0 0 20px 20px;
                margin-left: -24px;
                margin-right: -24px;
                padding-left: 48px;
                padding-right: 48px;
            }

            .header-content h1 {
                font-size: 26px;
            }

            .header-content p {
                font-size: 14px;
            }

            .survey-info {
                gap: 16px;
            }

            .form-container {
                padding: 0 24px 32px;
            }

            .form-section,
            .submit-section {
                padding: 24px;
            }

            .section-title {
                font-size: 18px;
            }

            .question-label {
                font-size: 14px;
            }

            .scale-options {
                flex-wrap: wrap;
                gap: 8px;
            }

            .scale-input {
                width: 32px;
                height: 32px;
            }
        }

        @media (max-width: 480px) {
            .page-container {
                padding: 0 16px;
            }

            .header {
                margin-bottom: 24px;
            }

            .header-banner {
                padding: 32px 16px;
                border-radius: 0 0 18px 18px;
                margin-left: -16px;
                margin-right: -16px;
                padding-left: 32px;
                padding-right: 32px;
            }

            .header-top {
                gap: 12px;
                margin-bottom: 20px;
            }

            .header-content h1 {
                font-size: 22px;
            }

            .header-content p {
                font-size: 13px;
            }

            .survey-category {
                font-size: 11px;
            }

            .back-btn {
                width: 36px;
                height: 36px;
            }

            .back-btn svg {
                width: 18px;
                height: 18px;
            }

            .survey-info {
                flex-direction: column;
                gap: 8px;
            }

            .info-item {
                font-size: 13px;
            }

            .form-container {
                padding: 0 16px 24px;
            }

            .form-section,
            .submit-section {
                padding: 20px;
                border-radius: 12px;
                margin-bottom: 16px;
            }

            .section-header {
                gap: 10px;
                margin-bottom: 20px;
            }

            .section-icon {
                width: 36px;
                height: 36px;
                font-size: 18px;
            }

            .section-title {
                font-size: 17px;
            }

            .question-group {
                margin-bottom: 24px;
            }

            .question-label {
                font-size: 14px;
                margin-bottom: 10px;
            }

            .input-field {
                padding: 10px 14px;
                font-size: 14px;
            }

            .submit-button,
            .nav-btn {
                width: 100%;
                padding: 12px 24px;
                font-size: 14px;
            }

            .scale-options {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }

            .scale-input {
                width: 30px;
                height: 30px;
            }

            .scale-labels {
                flex-direction: column;
                gap: 4px;
                align-items: flex-start;
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
                </div>
                <div class="header-content">
                    <div class="survey-category">{{ $survey->kategori->nama ?? 'UMUM' }}</div>
                    <h1>{{ $survey->nama }}</h1>
                    <p>{{ $survey->deskripsi }}</p>
                </div>
                <div class="survey-info">
                    <div class="info-item">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>5-10 menit</span>
                    </div>
                    <div class="info-item">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        <span>{{ $survey->pertanyaan->count() }} pertanyaan</span>
                    </div>
                    <div class="info-item">
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

        <!-- Form -->
        <form class="form-container" id="surveyForm" method="POST" action="{{ route('isi-survey.store', $survey->id_kuesioner) }}">
            @csrf
            <!-- Hidden inputs to maintain all answers across sections -->
            <div id="hidden-answers-container"></div>

            <!-- Identitas Section - Always visible but shown first -->
            <div id="identitas-section" class="form-section">
                <div class="section-header">
                    <div class="section-icon">👤</div>
                    <h2 class="section-title">Identitas</h2>
                </div>

                @if($survey->identitas)
                    @if($survey->identitas->wajib1 || $survey->identitas->atribut1)
                    <div class="question-group">
                        <label class="question-label">
                            {{ $survey->identitas->atribut1 }}{!! $survey->identitas->wajib1 ? '<span class="required">*</span>' : '' !!}
                        </label>
                        <input type="text" class="input-field" id="identitas1" name="identitas1" value="{{ old('identitas1', session('identitas1', '')) }}" placeholder="Masukkan {{ strtolower($survey->identitas->atribut1) }}" {!! $survey->identitas->wajib1 ? 'required' : '' !!}>
                    </div>
                    @endif

                    @if($survey->identitas->wajib2 || $survey->identitas->atribut2)
                    <div class="question-group">
                        <label class="question-label">
                            {{ $survey->identitas->atribut2 }}{!! $survey->identitas->wajib2 ? '<span class="required">*</span>' : '' !!}
                        </label>
                        <input type="text" class="input-field" id="identitas2" name="identitas2" value="{{ old('identitas2', session('identitas2', '')) }}" placeholder="Masukkan {{ strtolower($survey->identitas->atribut2) }}" {!! $survey->identitas->wajib2 ? 'required' : '' !!}>
                    </div>
                    @endif

                    @if($survey->identitas->wajib3 || $survey->identitas->atribut3)
                    <div class="question-group">
                        <label class="question-label">
                            {{ $survey->identitas->atribut3 }}{!! $survey->identitas->wajib3 ? '<span class="required">*</span>' : '' !!}
                        </label>
                        <input type="text" class="input-field" id="identitas3" name="identitas3" value="{{ old('identitas3', session('identitas3', '')) }}" placeholder="Masukkan {{ strtolower($survey->identitas->atribut3) }}" {!! $survey->identitas->wajib3 ? 'required' : '' !!}>
                    </div>
                    @endif

                    @if($survey->identitas->wajib4 || $survey->identitas->atribut4)
                    <div class="question-group">
                        <label class="question-label">
                            {{ $survey->identitas->atribut4 }}{!! $survey->identitas->wajib4 ? '<span class="required">*</span>' : '' !!}
                        </label>
                        <input type="text" class="input-field" id="identitas4" name="identitas4" value="{{ old('identitas4', session('identitas4', '')) }}" placeholder="Masukkan {{ strtolower($survey->identitas->atribut4) }}" {!! $survey->identitas->wajib4 ? 'required' : '' !!}>
                    </div>
                    @endif

                    @if($survey->identitas->wajib5 || $survey->identitas->atribut5)
                    <div class="question-group">
                        <label class="question-label">
                            {{ $survey->identitas->atribut5 }}{!! $survey->identitas->wajib5 ? '<span class="required">*</span>' : '' !!}
                        </label>
                        <input type="text" class="input-field" id="identitas5" name="identitas5" value="{{ old('identitas5', session('identitas5', '')) }}" placeholder="Masukkan {{ strtolower($survey->identitas->atribut5) }}" {!! $survey->identitas->wajib5 ? 'required' : '' !!}>
                    </div>
                    @endif
                @else
                    <!-- Default identitas fields jika tidak ada konfigurasi -->
                    <div class="question-group">
                        <label class="question-label">
                            Nama Lengkap<span class="required">*</span>
                        </label>
                        <input type="text" class="input-field" id="identitas1" name="identitas1" value="{{ old('identitas1', session('identitas1', '')) }}" placeholder="Masukkan nama lengkap Anda" required>
                    </div>

                    <div class="question-group">
                        <label class="question-label">
                            Email<span class="required">*</span>
                        </label>
                        <input type="email" class="input-field" id="identitas2" name="identitas2" value="{{ old('identitas2', session('identitas2', '')) }}" placeholder="nama@email.com" required>
                    </div>

                    <div class="question-group">
                        <label class="question-label">
                            Program Studi<span class="required">*</span>
                        </label>
                        <input type="text" class="input-field" id="identitas3" name="identitas3" value="{{ old('identitas3', session('identitas3', '')) }}" placeholder="Masukkan program studi Anda" required>
                    </div>
                @endif

                <!-- Next button for identitas -->
                <div class="nav-buttons">
                    <button type="button" class="nav-btn" disabled style="visibility: hidden;">Sebelumnya</button>
                    <button type="button" class="nav-btn next" onclick="saveCurrentDataAndShowPage(1)">Berikutnya</button>
                </div>
            </div>

            <!-- Questions Section - hidden initially -->
            <div id="questions-section" class="form-section" style="display: none;">
                <div class="section-header">
                    <div class="section-icon">📝</div>
                    <h2 class="section-title">Pertanyaan Survey</h2>
                </div>

                <div class="question-counter">
                    <span id="current-section">1</span> dari <span id="total-sections">1</span> Bagian
                </div>

                <!-- Question groups organized by sub sections -->
                <div id="questions-container">
                    <!-- Questions will be loaded dynamically -->
                </div>

                <!-- Navigation for questions -->
                <div class="nav-buttons">
                    <button type="button" class="nav-btn" id="prev-btn" onclick="goToPreviousSection()">Sebelumnya</button>
                    <button type="button" class="nav-btn next" id="next-btn" onclick="goToNextSection()">Berikutnya</button>
                </div>
            </div>

            <!-- Submit Section - hidden initially -->
            <div id="submit-section" class="submit-section" style="display: none;">
                <p>Terima kasih telah mengisi survey kami!</p>
                <button type="submit" class="submit-button">Kirim Jawaban</button>
            </div>
        </form>
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
                        document.getElementById('surveyForm').submit(); // Submit the form directly
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
                html += `<h3 class="sub-section-title">${section.title}</h3>`;
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
                    <div class="question-group">
                        <label class="question-label">
                            ${questionNumber}. ${question.text}
                        </label>
                        <div class="scale-container">
                            <div class="radio-group" style="display: flex; justify-content: space-between; width: 100%; margin: 10px 0;">
                                <label style="text-align: center; flex: 1; padding: 0 5px;">
                                    <input type="radio" name="jawaban[${question.id}]" value="1" class="scale-input" ${savedAnswer === '1' ? 'checked' : ''} style="display: block; margin: 0 auto 5px; width: 24px; height: 24px; cursor: pointer;">
                                    1<br><small>Sangat Buruk</small>
                                </label>
                                <label style="text-align: center; flex: 1; padding: 0 5px;">
                                    <input type="radio" name="jawaban[${question.id}]" value="2" class="scale-input" ${savedAnswer === '2' ? 'checked' : ''} style="display: block; margin: 0 auto 5px; width: 24px; height: 24px; cursor: pointer;">
                                    2<br><small>Buruk</small>
                                </label>
                                <label style="text-align: center; flex: 1; padding: 0 5px;">
                                    <input type="radio" name="jawaban[${question.id}]" value="3" class="scale-input" ${savedAnswer === '3' ? 'checked' : ''} style="display: block; margin: 0 auto 5px; width: 24px; height: 24px; cursor: pointer;">
                                    3<br><small>Cukup</small>
                                </label>
                                <label style="text-align: center; flex: 1; padding: 0 5px;">
                                    <input type="radio" name="jawaban[${question.id}]" value="4" class="scale-input" ${savedAnswer === '4' ? 'checked' : ''} style="display: block; margin: 0 auto 5px; width: 24px; height: 24px; cursor: pointer;">
                                    4<br><small>Baik</small>
                                </label>
                                <label style="text-align: center; flex: 1; padding: 0 5px;">
                                    <input type="radio" name="jawaban[${question.id}]" value="5" class="scale-input" ${savedAnswer === '5' ? 'checked' : ''} style="display: block; margin: 0 auto 5px; width: 24px; height: 24px; cursor: pointer;">
                                    5<br><small>Sangat Baik</small>
                                </label>
                            </div>
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

        // Function to save current data and show next page
        function saveCurrentDataAndShowPage(pageNum) {
            // Save identitas data to hidden inputs
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
    </script>
</body>
</html>