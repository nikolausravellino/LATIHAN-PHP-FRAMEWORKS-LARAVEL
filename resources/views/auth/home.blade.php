<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Autentikasi</title>
    
    <!-- Fonts and Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style type="text/tailwindcss">
        @layer base {
            body {
                font-family: 'Inter', sans-serif;
                @apply bg-gray-900 text-gray-200 min-h-screen flex items-center justify-center relative overflow-hidden;
            }
        }
        .jumbotron {
            @apply bg-white/10 backdrop-blur-md p-10 rounded-3xl shadow-2xl max-w-xl w-11/12 text-center relative z-10 border border-white/20;
        }
        .animated-text {
            @apply text-white font-bold tracking-wide animate-fade-in text-4xl sm:text-5xl;
        }
        .btn-glow {
            @apply bg-blue-600 border-none transition-all duration-300 transform-gpu hover:-translate-y-1 hover:bg-blue-700 shadow-xl shadow-blue-500/50 hover:shadow-blue-500/70 font-semibold;
        }
    </style>
    
</head>
<body class="bg-gradient-to-br from-blue-900 to-indigo-900">
    <!-- Particle Animation Canvas -->
    <canvas id="particleCanvas" class="absolute inset-0 w-full h-full z-0 opacity-50"></canvas>

    <div class="jumbotron"> 
        <h1 class="animated-text mb-4">
            Selamat Datang!
        </h1>
        
        <p class="text-xl mb-6 text-white/80 animate-fade-in-delay">
            Platform terintegrasi Anda. Silakan lanjutkan untuk masuk atau mendaftar.
        </p>
        
        <a class="btn btn-primary btn-lg btn-glow rounded-full px-8 py-3 mt-4 animate-fade-in-delay-2" href="{{ route('login') }}" role="button">
            Mulai Sekarang
        </a>
    </div>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        'fade-in': 'fadeIn 2s ease-in-out forwards',
                        'fade-in-delay': 'fadeIn 2s ease-in-out 0.5s forwards',
                        'fade-in-delay-2': 'fadeIn 2s ease-in-out 1s forwards',
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
            // Particle animation
            const canvas = document.getElementById('particleCanvas');
            const ctx = canvas.getContext('2d');
            let particles = [];
            const particleCount = 70;
            let animationFrameId;
            let mouseX = window.innerWidth / 2;
            let mouseY = window.innerHeight / 2;

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

                    // Re-spawn particles if they go off-screen
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
            
            window.addEventListener('mousemove', (event) => {
                mouseX = event.x;
                mouseY = event.y;
            });
            
            // Initial setup
            resizeCanvas();
            createParticles();
            animateParticles();
        };
    </script>
</body>
</html>
