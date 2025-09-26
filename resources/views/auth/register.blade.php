<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Autentikasi</title>
    
    <!-- Fonts and Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" xintegrity="sha512-ieoQeJ/nFw0S4sQp+Jv2v0vXl5O8fF5qfK5yR5a5e5yL5A5o5c5o5n5r5v5j5a5g5s5t5u5v5w5x5y5z5A5B5C5D5E5F5G5H5I5J5K5L5M5N5O5P5Q5R5S5T5U5V5W5X5Y5Z5a5b5c5d5e5f5g5h5i5j5k5l5m5n5o5p5q5r5s5t5u5v5w5x5y5z=" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style type="text/tailwindcss">
        @layer base {
            body {
                font-family: 'Inter', sans-serif;
                @apply bg-gray-900 text-gray-200 min-h-screen flex items-center justify-center relative overflow-hidden;
            }
        }
        .register-card {
            @apply bg-white/10 backdrop-blur-md p-10 rounded-3xl shadow-2xl max-w-2xl w-11/12 text-left relative z-10 border border-white/20;
        }
        .animated-heading {
            @apply text-white font-bold tracking-wide animate-fade-in text-2xl sm:text-3xl mb-6 text-center;
        }
        .btn-glow {
            @apply bg-blue-600 border-none transition-all duration-300 transform-gpu hover:-translate-y-1 hover:bg-blue-700 shadow-xl shadow-blue-500/50 hover:shadow-blue-500/70 font-semibold rounded-full px-8 py-3;
        }
        input {
            @apply w-full p-3 bg-white/5 border border-white/20 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors duration-200;
        }
        label {
            @apply block text-sm font-medium text-white/80 mb-1;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-900 to-indigo-900">
    <!-- Particle Animation Canvas -->
    <canvas id="particleCanvas" class="absolute inset-0 w-full h-full z-0 opacity-50"></canvas>

    <div class="register-card"> 
        <h4 class="animated-heading">Buat Akun Baru</h4>

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="name">Nama Pengguna</label>
                    <div class="relative">
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
                        <i class="fas fa-user absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                    @error('name')
                        <div class="text-red-400 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label for="full_name">Nama Lengkap</label>
                    <div class="relative">
                        <input id="full_name" type="text" name="full_name" value="{{ old('full_name') }}" required autocomplete="full_name">
                        <i class="fas fa-signature absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                    @error('full_name')
                        <div class="text-red-400 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-4">
                <label for="nim">NIM</label>
                <div class="relative">
                    <input id="nim" type="text" name="nim" value="{{ old('nim') }}" required autocomplete="nim">
                    <i class="fas fa-hashtag absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
                @error('nim')
                    <div class="text-red-400 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="email">Email</label>
                <div class="relative">
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username">
                    <i class="fas fa-envelope absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
                @error('email')
                    <div class="text-red-400 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="birth_place">Tempat Lahir</label>
                    <div class="relative">
                        <input id="birth_place" type="text" name="birth_place" value="{{ old('birth_place') }}" required autocomplete="birth_place">
                        <i class="fas fa-map-marker-alt absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                    @error('birth_place')
                        <div class="text-red-400 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label for="birth_date">Tanggal Lahir</label>
                    <div class="relative">
                        <input id="birth_date" type="date" name="birth_date" value="{{ old('birth_date') }}" required autocomplete="birth_date">
                        <i class="fas fa-calendar-alt absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                    @error('birth_date')
                        <div class="text-red-400 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="mb-4">
                <label for="photo">Unggah Foto Profil</label>
                <input id="photo" type="file" name="photo" accept="image/*" required>
                @error('photo')
                    <div class="text-red-400 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password">Password</label>
                <div class="relative">
                    <input id="password" type="password" name="password" required autocomplete="new-password">
                    <i class="fas fa-lock absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
                @error('password')
                    <div class="text-red-400 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password_confirmation">Konfirmasi Password</label>
                <div class="relative">
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">
                    <i class="fas fa-check-circle absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
                @error('password_confirmation')
                    <div class="text-red-400 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="flex justify-between items-center mt-4">
                <a class="text-sm text-blue-400 font-semibold hover:text-blue-200 transition-colors duration-200" href="{{ route('login') }}">
                    Sudah terdaftar?
                </a>
                <button type="submit" class="btn-glow">
                    Daftar
                </button>
            </div>
        </form>
    </div>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        'fade-in': 'fadeIn 2s ease-in-out forwards',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: 0, transform: 'translateY(20px)' },
                            '100%': { opacity: 1, transform: 'translateY(0)' },
                        }
                    }
                }
            }
        };

        window.onload = function() {
            // Particle animation script
            const canvas = document.getElementById('particleCanvas');
            const ctx = canvas.getContext('2d');
            let particles = [];
            const particleCount = 70;
            let animationFrameId;
            
            function resizeCanvas() {
                canvas.width = window.innerWidth;
                canvas.height = window.innerHeight;
            }

            class Particle {
                constructor() {
                    this.x = Math.random() * canvas.width;
                    this.y = Math.random() * canvas.height;
                    this.size = Math.random() * 2 + 1;
                    this.speedX = Math.random() * 0.5 - 0.25;
                    this.speedY = Math.random() * 0.5 - 0.25;
                    this.color = 'rgba(255, 255, 255, 0.4)';
                }

                update() {
                    this.x += this.speedX;
                    this.y += this.speedY;

                    if (this.x > canvas.width || this.x < 0) this.x = Math.random() * canvas.width;
                    if (this.y > canvas.height || this.y < 0) this.y = Math.random() * canvas.height;
                }

                draw() {
                    ctx.fillStyle = this.color;
                    ctx.beginPath();
                    ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
                    ctx.fill();
                }
            }

            function createParticles() {
                for (let i = 0; i < particleCount; i++) {
                    particles.push(new Particle());
                }
            }

            function connectParticles() {
                let opacityValue = 1;
                for (let a = 0; a < particles.length; a++) {
                    for (let b = a; b < particles.length; b++) {
                        const dx = particles[a].x - particles[b].x;
                        const dy = particles[a].y - particles[b].y;
                        const distance = Math.sqrt(dx * dx + dy * dy);

                        if (distance < 100) {
                            opacityValue = 1 - (distance / 100);
                            ctx.strokeStyle = `rgba(255, 255, 255, ${opacityValue})`;
                            ctx.lineWidth = 1;
                            ctx.beginPath();
                            ctx.moveTo(particles[a].x, particles[a].y);
                            ctx.lineTo(particles[b].x, particles[b].y);
                            ctx.stroke();
                        }
                    }
                }
            }

            function animateParticles() {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                for (let i = 0; i < particles.length; i++) {
                    particles[i].update();
                    particles[i].draw();
                }
                connectParticles();
                animationFrameId = requestAnimationFrame(animateParticles);
            }

            window.addEventListener('resize', () => {
                resizeCanvas();
                particles = [];
                createParticles();
            });
            
            resizeCanvas();
            createParticles();
            animateParticles();
        };
    </script>
</body>
</html>
