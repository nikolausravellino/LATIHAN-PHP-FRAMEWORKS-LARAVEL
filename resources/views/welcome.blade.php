<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Akademik</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    
    <style>
        body {
            /* Background gradien biru cerah yang sudah Anda gunakan di login */
            background: linear-gradient(135deg, #007bff 0%, #004494 100%); 
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white; /* Mengatur teks default menjadi putih */
        }
        .welcome-card {
            background-color: rgba(255, 255, 255, 0.95); /* Sedikit transparan putih */
            color: #343a40; /* Teks gelap di dalam card */
            padding: 3rem;
            border-radius: 1rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        }
        .btn-primary-custom {
            background-color: #004494; /* Warna biru gelap yang kontras */
            border-color: #004494;
        }
        .btn-primary-custom:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>
<body>
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-9 col-sm-11">
                
                <div class="welcome-card text-center">
                    
                    <div class="mb-4">
                        <img 
                            src="{{ asset('images/logo.png') }}" 
                            alt="Logo Aplikasi" 
                            style="height: 60px; margin-bottom: 15px;"
                        >
                        <h1 class="display-5 fw-bold text-primary">
                            Selamat Datang di Sistem Akademik
                        </h1>
                    </div>
                    
                    <p class="lead mb-5">
                        <i class="fas fa-rocket me-2"></i> Kelola data mahasiswa, nilai, dan jadwal kuliah Anda dengan platform yang terintegrasi dan aman.
                    </p>
                    
                    @if (Route::has('login'))
                        <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="btn btn-primary-custom btn-lg px-4 gap-3">
                                    <i class="fas fa-tachometer-alt me-2"></i> Ke Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-primary-custom btn-lg px-4">
                                    <i class="fas fa-sign-in-alt me-2"></i> Masuk
                                </a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn btn-outline-secondary btn-lg px-4">
                                        <i class="fas fa-user-plus me-2"></i> Daftar Akun
                                    </a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>