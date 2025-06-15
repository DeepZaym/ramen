@extends('layouts.layout')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RamenRush - Japanese Origin Terbaik di Indonesia</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            overflow-x: hidden;
        }

        .header {
            position: fixed;
            top: 0;
            width: 100%;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            z-index: 1000;
            padding: 15px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #e74c3c;
            text-decoration: none;
        }

        .nav-menu {
            display: flex;
            list-style: none;
            gap: 30px;
        }

        .nav-menu li a {
            text-decoration: none;
            color: #666;
            font-weight: 500;
            transition: color 0.3s ease;
            text-transform: uppercase;
            font-size: 14px;
            letter-spacing: 1px;
        }

        .nav-menu li a:hover {
            color: #e74c3c;
        }

        .hero {
            height: 100vh;
            background: linear-gradient(135deg,rgb(255, 255, 255) 0%,rgb(255, 255, 255) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .hero-content {
            text-align: center;
            color: #333;
            z-index: 10;
            max-width: 1000px;
            padding: 0 20px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
        }

        .hero h1 {
            font-size: clamp(3rem, 8vw, 6rem);
            font-weight: 900;
            margin-bottom: 30px;
            letter-spacing: 8px;
            color: #2c3e50;
            text-transform: uppercase;
            line-height: 1.2;
        }

        .hero p {
            font-size: clamp(1.2rem, 3vw, 2rem);
            font-weight: 400;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: #666;
            margin-top: 20px;
        }

        /* Floating Food Elements */
        .food-element {
            position: absolute;
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .sushi-1 {
            width: 120px;
            height: 120px;
            background: linear-gradient(45deg, #ff6b35, #f7931e);
            top: 15%;
            left: 8%;
            animation-delay: 0s;
        }

        .sushi-2 {
            width: 80px;
            height: 80px;
            background: linear-gradient(45deg, #27ae60, #2ecc71);
            top: 20%;
            right: 12%;
            animation-delay: 1s;
        }

        .sushi-3 {
            width: 100px;
            height: 100px;
            background: linear-gradient(45deg, #e74c3c, #c0392b);
            bottom: 25%;
            left: 12%;
            animation-delay: 2s;
        }

        .wasabi {
            width: 70px;
            height: 70px;
            background: linear-gradient(45deg, #2ecc71, #27ae60);
            top: 35%;
            left: 18%;
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
            animation-delay: 0.5s;
        }

        .chopsticks {
            width: 6px;
            height: 120px;
            background: linear-gradient(to bottom, #8b4513, #a0522d);
            position: absolute;
            top: 18%;
            right: 20%;
            transform: rotate(25deg);
            animation: rotate 12s linear infinite;
        }

        .chopsticks::after {
            content: '';
            width: 6px;
            height: 120px;
            background: linear-gradient(to bottom, #8b4513, #a0522d);
            position: absolute;
            left: 12px;
            transform: rotate(-10deg);
        }

        .sauce-bowl {
            width: 60px;
            height: 60px;
            background: linear-gradient(45deg, #2c3e50, #34495e);
            border-radius: 50%;
            bottom: 30%;
            right: 15%;
            animation-delay: 1.5s;
        }

        .blue-circle {
            width: 90px;
            height: 90px;
            background: linear-gradient(45deg, #3498db, #2980b9);
            border-radius: 50%;
            bottom: 15%;
            right: 8%;
            animation-delay: 3s;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px) rotate(0deg);
            }
            50% {
                transform: translateY(-20px) rotate(5deg);
            }
        }

        @keyframes rotate {
            0% {
                transform: rotate(25deg);
            }
            100% {
                transform: rotate(385deg);
            }
        }

        /* Particle Effects */
        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            pointer-events: none;
            animation: particle-float 10s linear infinite;
        }

        @keyframes particle-float {
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateY(-100px) rotate(360deg);
                opacity: 0;
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .nav-menu {
                gap: 15px;
            }

            .nav-menu li a {
                font-size: 12px;
            }

            .food-element {
                display: none;
            }

            .hero h1 {
                font-size: 2.5rem;
            }

            .hero p {
                font-size: 1rem;
                letter-spacing: 1px;
            }
        }

        /* Hover Effects */
        .hero:hover .food-element {
            animation-play-state: paused;
        }

        .hero-content {
            animation: fadeInUp 1.5s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translate(-50%, -40%);
            }
            to {
                opacity: 1;
                transform: translate(-50%, -50%);
            }
        }
    </style>
</head>
<body>
    <section class="hero">
        <!-- Floating Food Elements -->
        <div class="food-element sushi-1"></div>
        <div class="food-element sushi-2"></div>
        <div class="food-element sushi-3"></div>
        <div class="food-element wasabi"></div>
        <div class="food-element sauce-bowl"></div>
        <div class="food-element blue-circle"></div>
        <div class="chopsticks"></div>

        @if(Auth::check())
            <!-- Welcome message for logged in users -->
            <div class="user-welcome">
                <h2>Selamat Datang, {{ Auth::tb_users()->name }}!</h2>
                <p>Nikmati kelezatan masakan Jepang autentik kami</p>
            </div>
        @endif

        <div class="hero-content">
            <h1>OUR TABEMONO</h1>
            <p>Japanese Origin Terbaik di Indonesia</p>
        </div>
    </section>

    <script>
        // Add smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Add parallax effect on scroll
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const parallax = document.querySelector('.hero');
            const speed = scrolled * 0.5;
            parallax.style.transform = `translateY(${speed}px)`;
        });

        // Add interactive hover effects
        const foodElements = document.querySelectorAll('.food-element');
        foodElements.forEach(element => {
            element.addEventListener('mouseenter', () => {
                element.style.transform = 'scale(1.2) rotate(10deg)';
                element.style.transition = 'transform 0.3s ease';
            });

            element.addEventListener('mouseleave', () => {
                element.style.transform = 'scale(1) rotate(0deg)';
            });
        });
    </script>
</body>
</html>
@endsection
