<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
        
        <style>
            /* Terapkan Font Poppins dan Gaya Background Gradient */
            body {
                font-family: 'Poppins', sans-serif;
                /* Background Gradient Biru Tua */
                background: linear-gradient(135deg, #004494 0%, #3498db 100%);
                color: #495057; 
            }

            /* Gaya untuk div utama (Pengganti min-vh-100 di Breeze) */
            .min-vh-100 { 
                /* Pastikan Flexbox aktif untuk centering */
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                min-height: 100vh !important; /* Gunakan !important untuk memastikan override */
            }

            /* Gaya untuk Card Login/Register */
            .card {
                border: none !important;
                border-radius: 15px !important;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2) !important;
            }

            /* Gaya Tombol Primary yang Seragam (Biru Tua) */
            .btn-primary {
                background-color: #004494 !important;
                border-color: #004494 !important;
                font-weight: 600;
                transition: background-color 0.3s ease;
            }
            .btn-primary:hover {
                background-color: #0056b3 !important;
                border-color: #0056b3 !important;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="d-flex flex-column justify-content-center align-items-center min-vh-100">
            <div class="mb-4">
            <a href="{{ url('/') }}" class="d-block text-center">
                <img 
                    src="{{ asset('images/logo.png') }}" 
                    alt="AuthX Logo" 
                    style="height: 100px; max-width: 100%;" // <--- Ubah nilai height ini
                >
            </a>
            <div class="card p-4 shadow-sm" style="width: 24rem;">
                {{ $slot }}
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>