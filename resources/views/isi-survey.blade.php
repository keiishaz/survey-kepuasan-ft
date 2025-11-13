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
            <!-- Identitas Section -->
            <div class="form-section">
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
                        <input type="text" class="input-field" name="identitas1" placeholder="Masukkan {{ strtolower($survey->identitas->atribut1) }}" {!! $survey->identitas->wajib1 ? 'required' : '' !!}>
                    </div>
                    @endif

                    @if($survey->identitas->wajib2 || $survey->identitas->atribut2)
                    <div class="question-group">
                        <label class="question-label">
                            {{ $survey->identitas->atribut2 }}{!! $survey->identitas->wajib2 ? '<span class="required">*</span>' : '' !!}
                        </label>
                        <input type="text" class="input-field" name="identitas2" placeholder="Masukkan {{ strtolower($survey->identitas->atribut2) }}" {!! $survey->identitas->wajib2 ? 'required' : '' !!}>
                    </div>
                    @endif

                    @if($survey->identitas->wajib3 || $survey->identitas->atribut3)
                    <div class="question-group">
                        <label class="question-label">
                            {{ $survey->identitas->atribut3 }}{!! $survey->identitas->wajib3 ? '<span class="required">*</span>' : '' !!}
                        </label>
                        <input type="text" class="input-field" name="identitas3" placeholder="Masukkan {{ strtolower($survey->identitas->atribut3) }}" {!! $survey->identitas->wajib3 ? 'required' : '' !!}>
                    </div>
                    @endif

                    @if($survey->identitas->wajib4 || $survey->identitas->atribut4)
                    <div class="question-group">
                        <label class="question-label">
                            {{ $survey->identitas->atribut4 }}{!! $survey->identitas->wajib4 ? '<span class="required">*</span>' : '' !!}
                        </label>
                        <input type="text" class="input-field" name="identitas4" placeholder="Masukkan {{ strtolower($survey->identitas->atribut4) }}" {!! $survey->identitas->wajib4 ? 'required' : '' !!}>
                    </div>
                    @endif

                    @if($survey->identitas->wajib5 || $survey->identitas->atribut5)
                    <div class="question-group">
                        <label class="question-label">
                            {{ $survey->identitas->atribut5 }}{!! $survey->identitas->wajib5 ? '<span class="required">*</span>' : '' !!}
                        </label>
                        <input type="text" class="input-field" name="identitas5" placeholder="Masukkan {{ strtolower($survey->identitas->atribut5) }}" {!! $survey->identitas->wajib5 ? 'required' : '' !!}>
                    </div>
                    @endif
                @else
                    <!-- Default identitas fields jika tidak ada konfigurasi -->
                    <div class="question-group">
                        <label class="question-label">
                            Nama Lengkap<span class="required">*</span>
                        </label>
                        <input type="text" class="input-field" name="identitas1" placeholder="Masukkan nama lengkap Anda" required>
                    </div>

                    <div class="question-group">
                        <label class="question-label">
                            Email<span class="required">*</span>
                        </label>
                        <input type="email" class="input-field" name="identitas2" placeholder="nama@email.com" required>
                    </div>

                    <div class="question-group">
                        <label class="question-label">
                            Program Studi<span class="required">*</span>
                        </label>
                        <input type="text" class="input-field" name="identitas3" placeholder="Masukkan program studi Anda" required>
                    </div>
                @endif
            </div>

            <!-- Submit Section -->
            <div class="submit-section">
                <button type="submit" class="submit-button">
                    Berikutnya




















                    
                    
                    
                    
                    
                    
                    
                    
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </div>
        </form>
    </div>


</body>
</html>