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
            background: linear-gradient(135deg, #f0f9ff 0%, #fefce8 100%);
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
            background: linear-gradient(135deg, #3b82f6 0%, #f59e0b 100%); /* primary-500 to accent-500 from dashboard */
            border-radius: 0 0 24px 24px;
            padding: 48px 40px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(59, 130, 246, 0.15);
            margin-left: -40px;
            margin-right: -40px;
            padding-left: 80px;
            padding-right: 80px;
            text-align: center;
            color: white;
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
            top: -80px;
            right: 10%;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.15);
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
            color: white;
        }

        .header-content h1 {
            font-size: 36px;
            font-weight: 800;
            color: white;
            margin-bottom: 12px;
            letter-spacing: -0.5px;
        }

        .header-content p {
            font-size: 18px;
            color: rgba(255, 255, 255, 0.9);
            font-weight: 400;
        }

        /* Content */
        .content {
            padding: 0 24px 48px;
            text-align: center;
        }

        .message {
            font-size: 18px;
            color: #1e40af; /* primary-700 from dashboard */
            margin-bottom: 32px;
            line-height: 1.7;
            font-weight: 500;
        }

        .survey-title {
            font-size: 22px;
            font-weight: 700;
            color: #1e40af; /* primary-700 from dashboard */
            margin-bottom: 8px;
            padding: 16px;
            background: rgba(219, 234, 254, 0.4); /* primary-100 equivalent */
            border-radius: 16px;
            border-left: 4px solid #3b82f6; /* primary-500 from dashboard */
        }

        .actions {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 16px;
        }

        .action-button {
            padding: 16px 28px;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
            border: none;
            min-width: 180px;
        }

        .action-button-primary {
            background: linear-gradient(135deg, #3b82f6 0%, #f59e0b 100%); /* primary-500 to accent-500 from dashboard */
            color: white;
            box-shadow: 0 4px 6px rgba(59, 130, 246, 0.2);
        }

        .action-button-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px rgba(59, 130, 246, 0.3);
        }

        .action-button-secondary {
            background: white;
            color: #1e40af; /* primary-700 from dashboard */
            border: 2px solid rgba(59, 130, 246, 0.3); /* primary-500 from dashboard */
        }

        .action-button-secondary:hover {
            background: #dbeafe; /* primary-100 from dashboard */
            border-color: #3b82f6; /* primary-500 from dashboard */
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(59, 130, 246, 0.1);
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
                font-size: 72px;
                margin-bottom: 16px;
            }

            .header-content h1 {
                font-size: 30px;
            }

            .header-content p {
                font-size: 16px;
            }

            .content {
                padding: 0 24px 32px;
            }

            .message {
                font-size: 17px;
            }

            .survey-title {
                font-size: 20px;
            }

            .actions {
                flex-direction: column;
                gap: 16px;
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
                font-size: 64px;
                margin-bottom: 12px;
            }

            .header-content h1 {
                font-size: 26px;
            }

            .header-content p {
                font-size: 15px;
            }

            .content {
                padding: 0 16px 24px;
            }

            .message {
                font-size: 16px;
                margin-bottom: 24px;
            }

            .survey-title {
                font-size: 18px;
            }

            .action-button {
                padding: 14px 24px;
                font-size: 15px;
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