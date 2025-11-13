<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPULAS - Terima Kasih</title>
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
            max-width: 700px;
            margin: 0 auto;
            padding: 0 24px;
            width: 100%;
        }

        /* Header */
        .header {
            margin-bottom: 48px;
        }

        .header-banner {
            background: linear-gradient(135deg, #059669 0%, #d9f99d 100%);
            border-radius: 0 0 24px 24px;
            padding: 48px 40px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
            margin-left: -40px;
            margin-right: -40px;
            padding-left: 80px;
            padding-right: 80px;
            text-align: center;
        }

        @media (min-width: 740px) {
            .header-banner {
                margin-left: calc((100vw - 700px) / -2);
                margin-right: calc((100vw - 700px) / -2);
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

        .header-content {
            position: relative;
            z-index: 2;
        }

        .thank-you-icon {
            font-size: 80px;
            margin-bottom: 24px;
        }

        .header-content h1 {
            font-size: 32px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 12px;
            letter-spacing: -0.5px;
        }

        .header-content p {
            font-size: 16px;
            color: #4b5563;
            font-weight: 400;
        }

        /* Content */
        .content {
            padding: 0 24px 48px;
            text-align: center;
        }

        .message {
            font-size: 18px;
            color: #374151;
            margin-bottom: 32px;
            line-height: 1.7;
        }

        .survey-title {
            font-size: 20px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 8px;
        }

        .actions {
            display: flex;
            gap: 16px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .action-button {
            padding: 12px 24px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
        }

        .action-button-primary {
            background: #3b82f6;
            color: white;
            border-color: #3b82f6;
        }

        .action-button-primary:hover {
            background: #2563eb;
            border-color: #2563eb;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .action-button-secondary {
            background: white;
            color: #374151;
        }

        .action-button-secondary:hover {
            background: #f9fafb;
            border-color: #9ca3af;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header {
                margin-bottom: 32px;
            }

            .header-banner {
                padding: 40px 24px;
                border-radius: 0 0 20px 20px;
                margin-left: -24px;
                margin-right: -24px;
                padding-left: 48px;
                padding-right: 48px;
            }

            .thank-you-icon {
                font-size: 64px;
                margin-bottom: 16px;
            }

            .header-content h1 {
                font-size: 26px;
            }

            .header-content p {
                font-size: 15px;
            }

            .content {
                padding: 0 24px 32px;
            }

            .message {
                font-size: 16px;
            }

            .survey-title {
                font-size: 18px;
            }

            .actions {
                flex-direction: column;
            }

            .action-button {
                width: 100%;
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
                padding: 36px 16px;
                border-radius: 0 0 18px 18px;
                margin-left: -16px;
                margin-right: -16px;
                padding-left: 32px;
                padding-right: 32px;
            }

            .thank-you-icon {
                font-size: 56px;
                margin-bottom: 12px;
            }

            .header-content h1 {
                font-size: 22px;
            }

            .header-content p {
                font-size: 14px;
            }

            .content {
                padding: 0 16px 24px;
            }

            .message {
                font-size: 15px;
                margin-bottom: 24px;
            }

            .survey-title {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <div class="page-container">
        <!-- Header -->
        <div class="header">
            <div class="header-banner">
                <div class="header-content">
                    <div class="thank-you-icon">✓</div>
                    <h1>Terima Kasih!</h1>
                    <p>Semoga hari Anda menyenangkan</p>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="survey-title">{{ $survey->nama }}</div>
            <div class="message">
                Jawaban Anda telah kami terima. 
                Partisipasi Anda sangat berharga untuk meningkatkan kualitas layanan kami.
            </div>
            
            <div class="actions">
                <a href="{{ url('/cari-survey') }}" class="action-button action-button-primary">
                    Isi Survey Lain
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
                <a href="{{ url('/') }}" class="action-button action-button-secondary">
                    Kembali ke Beranda
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</body>
</html>