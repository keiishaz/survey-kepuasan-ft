<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPULAS - Terima Kasih</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f8fafc; /* Light grayish-white background to match survey page */
        }

        .formbold-main-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        .formbold-form-wrapper {
            margin: 0 auto;
            max-width: 700px; /* Same width as survey page */
            width: 100%;
            background: white;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
        }

        .formbold-header {
            background: linear-gradient(135deg, #bae6fd 0%, #fef3c7 100%); /* Same gradient as survey page */
            border-radius: 12px 12px 0 0;
            padding: 24px;
            margin-bottom: 20px;
            position: relative;
            overflow: hidden;
            color: #1e293b;
            text-align: center;
        }

        .formbold-header::before {
            content: '';
            position: absolute;
            top: -60px;
            right: 8%;
            width: 160px;
            height: 160px;
            background: rgba(30, 41, 59, 0.1);
            border-radius: 50%;
            z-index: 1;
        }

        .formbold-header-content {
            position: relative;
            z-index: 2;
        }

        .thank-you-icon {
            font-size: 64px;
            margin-bottom: 12px;
            color: #1e293b;
        }

        .formbold-thank-you-title {
            font-size: 24px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 8px;
            letter-spacing: -0.2px;
        }

        .formbold-thank-you-message {
            font-size: 14px;
            color: #374151;
            font-weight: 400;
            max-width: 600px;
        }

        .formbold-content {
            text-align: center;
            padding: 20px 0;
        }

        .formbold-survey-title {
            font-size: 18px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 16px;
            padding: 16px;
            background: #f1f5f9;
            border-radius: 8px;
            border-left: 2px solid #bae6fd;
        }

        .formbold-thank-you-message-text {
            font-size: 15px;
            color: #374151;
            margin-bottom: 24px;
            line-height: 1.6;
            font-weight: 500;
        }

        .formbold-actions {
            display: flex;
            gap: 12px;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }

        .formbold-action-btn {
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
            text-decoration: none;
        }

        .formbold-action-btn:hover {
            background: #f1f5f9;
            border-color: #94a3b8;
        }

        .formbold-action-btn.primary {
            background: #3b82f6;
            color: white;
            border: none;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }

        .formbold-action-btn.primary:hover {
            background: #2563eb;
            transform: translateY(-1px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 768px) {
            .formbold-main-wrapper {
                padding: 16px;
            }

            .formbold-form-wrapper {
                padding: 20px;
            }

            .formbold-header {
                padding: 24px;
            }

            .thank-you-icon {
                font-size: 56px;
                margin-bottom: 10px;
            }

            .formbold-thank-you-title {
                font-size: 22px;
            }

            .formbold-thank-you-message {
                font-size: 14px;
            }

            .formbold-survey-title {
                font-size: 17px;
                padding: 14px;
            }

            .formbold-thank-you-message-text {
                font-size: 15px;
            }
        }

        @media (max-width: 480px) {
            .formbold-main-wrapper {
                padding: 12px;
            }

            .formbold-form-wrapper {
                padding: 18px;
            }

            .formbold-header {
                padding: 20px;
            }

            .thank-you-icon {
                font-size: 48px;
                margin-bottom: 8px;
            }

            .formbold-thank-you-title {
                font-size: 20px;
                margin-bottom: 6px;
            }

            .formbold-thank-you-message {
                font-size: 13px;
            }

            .formbold-survey-title {
                font-size: 17px;
                padding: 14px;
            }

            .formbold-thank-you-message-text {
                font-size: 14px;
                margin-bottom: 20px;
            }

            .formbold-actions {
                flex-direction: column;
                gap: 12px;
            }

            .formbold-action-btn {
                width: 100%;
                padding: 12px 18px;
                font-size: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="formbold-main-wrapper">
        <div class="formbold-form-wrapper">
            <!-- Header -->
            <div class="formbold-header">
                <div class="formbold-header-content">
                    <div class="thank-you-icon">✓</div>
                    <h1 class="formbold-thank-you-title">Terima Kasih!</h1>
                    <p class="formbold-thank-you-message">Partisipasi Anda sangat berharga untuk meningkatkan kualitas layanan kami</p>
                </div>
            </div>

            <!-- Content -->
            <div class="formbold-content">
                <div class="formbold-survey-title">{{ $survey->nama }}</div>
                <div class="formbold-thank-you-message-text">
                    Jawaban Anda telah kami terima.<br>
                    Terima kasih atas waktu yang Anda luangkan untuk mengisi survey ini.
                </div>

                <div class="formbold-actions">
                    <a href="{{ url('/cari-survey') }}" class="formbold-action-btn primary">
                        Isi Survey Lain
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                    <a href="{{ url('/') }}" class="formbold-action-btn">
                        Kembali ke Beranda
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>