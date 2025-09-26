<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Autentikasi</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style type="text/tailwindcss">
        @layer base {
            body {
                font-family: 'Inter', sans-serif;
                @apply bg-gray-900 text-gray-200 min-h-screen flex items-center justify-center relative overflow-hidden;
            }
        }
        .login-card {
            @apply bg-white/10 backdrop-blur-md p-10 rounded-3xl shadow-2xl max-w-lg w-11/12 text-center relative z-10 border border-white/20;
        }
        .animated-heading {
            @apply text-white font-bold tracking-wide animate-fade-in text-2xl sm:text-3xl mb-6;
        }
        .btn-glow {
            @apply bg-blue-600 border-none transition-all duration-300 transform-gpu hover:-translate-y-1 hover:bg-blue-700 shadow-xl shadow-blue-500/50 hover:shadow-blue-500/70 font-semibold rounded-full px-8 py-3;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-900 to-indigo-900">
    <!-- Particle Animation Canvas -->
    <canvas id="particleCanvas" class="absolute inset-0 w-full h-full z-0 opacity-50"></canvas>

    <div class="login-card"> 
        <h4 class="animated-heading">Masuk ke Akun Anda</h4>

        @if (session('status'))
            <div class="bg-green-500 text-white p-3 rounded-md mb-4 animate-fade-in">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4 text-left">
                <label for="email" class="block text-sm font-medium text-white/80 mb-1">Email</label>
                <input id="email" type="email" name="email" class="w-full p-3 bg-white/5 border border-white/20 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors duration-200" value="{{ old('email') }}" required autofocus autocomplete="username">
                @error('email')
                    <div class="text-red-400 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4 text-left">
                <label for="password" class="block text-sm font-medium text-white/80 mb-1">Password</label>
                <input id="password" type="password" name="password" class="w-full p-3 bg-white/5 border border-white/20 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors duration-200" required autocomplete="current-password">
                @error('password')
                    <div class="text-red-400 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex justify-between items-center mb-6">
                <div class="flex items-center">
                    <input id="remember_me" type="checkbox" name="remember" class="form-checkbox h-4 w-4 text-blue-600 bg-gray-700 rounded border-gray-600 focus:ring-blue-500">
                    <label for="remember_me" class="ml-2 text-sm text-gray-400">Ingat saya</label>
                </div>
                @if (Route::has('password.request'))
                    <a class="text-sm text-blue-400 hover:text-blue-200 transition-colors duration-200" href="{{ route('password.request') }}">
                        Lupa password?
                    </a>
                @endif
            </div>

            <button type="submit" class="w-full btn-glow">
                Masuk
            </button>
            
            <hr class="my-6 border-white/20">

            <div class="text-center">
                <p class="text-sm text-white/60">Belum punya akun? <a href="{{ route('register') }}" class="text-blue-400 font-semibold hover:text-blue-200 transition-colors duration-200">Daftar sekarang</a></p>
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
            // Particle animation script is included here for consistency
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
