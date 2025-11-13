<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPULAS - {{ $survey->nama }}</title>
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

        .question-container {
            margin-bottom: 32px;
        }

        /* Progress */
        .progress-container {
            margin-bottom: 20px;
        }

        .progress-bar {
            height: 8px;
            background: #e5e7eb;
            border-radius: 4px;
            overflow: hidden;
            margin-bottom: 8px;
        }

        .progress-fill {
            height: 100%;
            background: #3b82f6;
            border-radius: 4px;
            transition: width 0.3s ease;
        }

        .progress-text {
            font-size: 14px;
            color: #6b7280;
            text-align: right;
        }

        /* Question */
        .question-card {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            padding: 32px;
            margin-bottom: 24px;
        }

        .question-number {
            font-size: 14px;
            font-weight: 600;
            color: #3b82f6;
            margin-bottom: 8px;
        }

        .question-text {
            font-size: 16px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 20px;
        }

        .answer-options {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .answer-option {
            display: flex;
            align-items: center;
            padding: 12px 16px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .answer-option:hover {
            background: #f3f4f6;
            border-color: #9ca3af;
        }

        .answer-option.selected {
            background: #dbeafe;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .answer-option input[type="radio"],
        .answer-option input[type="checkbox"] {
            margin-right: 12px;
        }

        .answer-label {
            flex: 1;
            font-size: 15px;
            color: #111827;
        }

        /* Textarea */
        .answer-textarea {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 15px;
            background: white;
            transition: all 0.2s ease;
            color: #111827;
            min-height: 120px;
        }

        .answer-textarea:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.08);
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

            .question-card,
            .submit-section {
                padding: 24px;
            }

            .question-text {
                font-size: 15px;
            }

            .answer-option {
                padding: 10px 14px;
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

            .question-card,
            .submit-section {
                padding: 20px;
                border-radius: 12px;
                margin-bottom: 16px;
            }

            .question-text {
                font-size: 14px;
                margin-bottom: 16px;
            }

            .answer-option {
                padding: 10px 12px;
                font-size: 14px;
            }

            .answer-textarea {
                padding: 10px 12px;
                font-size: 14px;
            }

            .submit-button {
                width: 100%;
                padding: 12px 24px;
                font-size: 14px;
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        <span>{{ $pertanyaan->count() }} pertanyaan</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form -->
        <form class="form-container" id="surveyForm" method="POST" action="{{ route('isi-survey.pertanyaan.store', ['id' => $survey->id_kuesioner, 'responden' => $responden->id_responden]) }}">
            @csrf
            <!-- Progress -->
            <div class="progress-container">
                <div class="progress-bar">
                    <div class="progress-fill" id="progressFill" style="width: 0%;"></div>
                </div>
                <div class="progress-text" id="progressText">0/{{ $pertanyaan->count() }} pertanyaan dijawab</div>
            </div>

            <!-- Questions -->
            @foreach($pertanyaan as $index => $pertanyaanItem)
            <div class="question-container" data-question-id="{{ $pertanyaanItem->id_pertanyaan }}">
                <div class="question-card">
                    <div class="question-number">Pertanyaan {{ $index + 1 }}</div>
                    <div class="question-text">{{ $pertanyaanItem->teks }}</div>
                    <div class="answer-options">
                        <input type="text" class="answer-textarea" name="jawaban[{{ $pertanyaanItem->id_pertanyaan }}]" placeholder="Tulis jawaban Anda disini..." required>
                    </div>
                </div>
            </div>
            @endforeach

            <!-- Submit Section -->
            <div class="submit-section">
                <button type="submit" class="submit-button">
                    Kirim Jawaban
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('surveyForm');
            const totalQuestions = {{ $pertanyaan->count() }};
            const progressFill = document.getElementById('progressFill');
            const progressText = document.getElementById('progressText');
            
            // Update progress when answers change
            const answerInputs = document.querySelectorAll('.answer-textarea');
            answerInputs.forEach(input => {
                input.addEventListener('input', updateProgress);
            });
            
            function updateProgress() {
                let answeredCount = 0;
                answerInputs.forEach(input => {
                    if (input.value.trim() !== '') {
                        answeredCount++;
                    }
                });
                
                const progressPercentage = (answeredCount / totalQuestions) * 100;
                progressFill.style.width = progressPercentage + '%';
                progressText.textContent = answeredCount + '/' + totalQuestions + ' pertanyaan dijawab';
            }
            
            // Initial progress update
            updateProgress();
        });
    </script>
</body>
</html>