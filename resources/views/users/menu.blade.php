<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RamenRush - Mie Ramen Menu</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            min-height: 100vh;
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

        .main-content {
            margin-top: 80px;
            padding: 40px 20px;
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
        }

        .page-title {
            text-align: center;
            font-size: 3rem;
            font-weight: bold;
            color: #e74c3c;
            margin-bottom: 20px;
            letter-spacing: 2px;
        }

        .page-subtitle {
            text-align: center;
            font-size: 1.2rem;
            color: #666;
            margin-bottom: 50px;
            font-style: italic;
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
            margin-bottom: 60px;
        }

        .menu-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: all 0.3s ease;
            position: relative;
            cursor: pointer;
        }

        .menu-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .card-image {
            width: 100%;
            height: 250px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .menu-card:hover .card-image {
            transform: scale(1.05);
        }

        .card-content {
            padding: 25px;
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .card-description {
            color: #666;
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .card-price {
            font-size: 1.3rem;
            font-weight: bold;
            color: #e74c3c;
            margin-bottom: 15px;
        }

        .card-button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #e74c3c, #c0392b);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .card-button:hover {
            background: linear-gradient(135deg, #c0392b, #a93226);
            transform: translateY(-2px);
        }

        .badge {
            position: absolute;
            top: 15px;
            left: 15px;
            background: #e74c3c;
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: bold;
            text-transform: uppercase;
        }

        .badge.popular {
            background: #f39c12;
        }

        .badge.new {
            background: #27ae60;
        }

        .badge.spicy {
            background: #e74c3c;
        }

        .rating {
            display: flex;
            align-items: center;
            gap: 5px;
            margin-bottom: 10px;
        }

        .stars {
            color: #f39c12;
            font-size: 1.1rem;
        }

        .rating-text {
            color: #666;
            font-size: 0.9rem;
        }

        .ingredients {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 15px;
        }

        .ingredient-tag {
            background: #ecf0f1;
            color: #2c3e50;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .filter-section {
            text-align: center;
            margin-bottom: 40px;
        }

        .filter-buttons {
            display: inline-flex;
            gap: 15px;
            background: white;
            padding: 8px;
            border-radius: 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .filter-btn {
            padding: 10px 20px;
            border: none;
            background: transparent;
            color: #666;
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .filter-btn.active,
        .filter-btn:hover {
            background: #e74c3c;
            color: white;
        }

        .stats-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 50px;
        }

        .stat-card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: #e74c3c;
            margin-bottom: 10px;
        }

        .stat-label {
            color: #666;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 2000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(5px);
        }

        .modal-content {
            background: white;
            margin: 5% auto;
            padding: 0;
            border-radius: 15px;
            width: 90%;
            max-width: 600px;
            position: relative;
            animation: modalSlideIn 0.3s ease-out;
        }

        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-header {
            position: relative;
            height: 250px;
            overflow: hidden;
        }

        .modal-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .close-btn {
            position: absolute;
            top: 15px;
            right: 20px;
            background: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            font-size: 1.5rem;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .close-btn:hover {
            background: rgba(0, 0, 0, 0.7);
        }

        .modal-body {
            padding: 30px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .nav-menu {
                display: none;
            }

            .page-title {
                font-size: 2rem;
            }

            .menu-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .filter-buttons {
                flex-direction: column;
                width: 100%;
            }

            .stats-section {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 480px) {
            .stats-section {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="nav-container">
            <a href="#" class="logo">RamenRush</a>
            <nav>
                <ul class="nav-menu">
                <li><a href="{{ route('landing') }}">Home</a></li>
                <li><a href="{{ route('menu') }}">Menu</a></li>
                <li><a href="{{ route('order') }}">Order</a></li>
                <li><a href="{{ route('pembayaran') }}">Pembayaran</a></li>
                <li><a href="#  ">Kontak</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="main-content">
        <h1 class="page-title">Mie Ramen</h1>
        <p class="page-subtitle">Authentic Japanese Ramen - Crafted with Love and Tradition</p>

        <!-- Stats Section -->
        <section class="stats-section">
            <div class="stat-card">
                <div class="stat-number">12</div>
                <div class="stat-label">Ramen Variants</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">4.8</div>
                <div class="stat-label">Average Rating</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">2.5K+</div>
                <div class="stat-label">Happy Customers</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">15min</div>
                <div class="stat-label">Prep Time</div>
            </div>
        </section>

        <!-- Filter Section -->
        <section class="filter-section">
            <div class="filter-buttons">
                <button class="filter-btn active" data-filter="all">Semua</button>
                <button class="filter-btn" data-filter="popular">Populer</button>
                <button class="filter-btn" data-filter="spicy">Pedas</button>
                <button class="filter-btn" data-filter="new">Baru</button>
            </div>
        </section>

        <!-- Menu Grid -->
        <section class="menu-grid">
            <div class="menu-card" data-category="popular spicy">
                <div class="badge popular">Populer</div>
                <img src="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 400 250'><rect fill='%23f8f9fa' width='400' height='250'/><circle cx='200' cy='125' r='60' fill='%23e74c3c'/><text x='200' y='135' text-anchor='middle' fill='white' font-size='16' font-weight='bold'>Shoyu Ramen</text></svg>" alt="Shoyu Ramen" class="card-image">
                <div class="card-content">
                    <h3 class="card-title">Shoyu Ramen</h3>
                    <div class="rating">
                        <span class="stars">★★★★★</span>
                        <span class="rating-text">(4.9) 127 reviews</span>
                    </div>
                    <p class="card-description">Kaldu ayam yang kaya dengan kecap asin Jepang, dilengkapi chashu, telur rebus, dan sayuran segar.</p>
                    <div class="ingredients">
                        <span class="ingredient-tag">Chashu</span>
                        <span class="ingredient-tag">Soft Egg</span>
                        <span class="ingredient-tag">Nori</span>
                        <span class="ingredient-tag">Green Onion</span>
                    </div>
                    <div class="card-price">Rp 45.000</div>
                    <button class="card-button">Pesan Sekarang</button>
                </div>
            </div>

            <div class="menu-card" data-category="spicy">
                <div class="badge spicy">Pedas</div>
                <img src="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 400 250'><rect fill='%23f8f9fa' width='400' height='250'/><circle cx='200' cy='125' r='60' fill='%23f39c12'/><text x='200' y='135' text-anchor='middle' fill='white' font-size='16' font-weight='bold'>Spicy Miso</text></svg>" alt="Spicy Miso Ramen" class="card-image">
                <div class="card-content">
                    <h3 class="card-title">Spicy Miso Ramen</h3>
                    <div class="rating">
                        <span class="stars">★★★★☆</span>
                        <span class="rating-text">(4.7) 89 reviews</span>
                    </div>
                    <p class="card-description">Kuah miso pedas dengan pasta cabai Korea, dilengkapi telur, jagung, dan daging panggang.</p>
                    <div class="ingredients">
                        <span class="ingredient-tag">Spicy Miso</span>
                        <span class="ingredient-tag">Corn</span>
                        <span class="ingredient-tag">Soft Egg</span>
                        <span class="ingredient-tag">Meat</span>
                    </div>
                    <div class="card-price">Rp 52.000</div>
                    <button class="card-button">Pesan Sekarang</button>
                </div>
            </div>

            <div class="menu-card" data-category="new">
                <div class="badge new">Baru</div>
                <img src="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 400 250'><rect fill='%23f8f9fa' width='400' height='250'/><circle cx='200' cy='125' r='60' fill='%232c3e50'/><text x='200' y='135' text-anchor='middle' fill='white' font-size='16' font-weight='bold'>Black Garlic</text></svg>" alt="Black Garlic Ramen" class="card-image">
                <div class="card-content">
                    <h3 class="card-title">Black Garlic Ramen</h3>
                    <div class="rating">
                        <span class="stars">★★★★★</span>
                        <span class="rating-text">(4.8) 54 reviews</span>
                    </div>
                    <p class="card-description">Kuah tonkotsu hitam dengan black garlic oil, chashu tebal, dan nori premium untuk pengalaman rasa yang unik.</p>
                    <div class="ingredients">
                        <span class="ingredient-tag">Black Garlic</span>
                        <span class="ingredient-tag">Thick Chashu</span>
                        <span class="ingredient-tag">Premium Nori</span>
                        <span class="ingredient-tag">Bean Sprouts</span>
                    </div>
                    <div class="card-price">Rp 58.000</div>
                    <button class="card-button">Pesan Sekarang</button>
                </div>
            </div>

            <div class="menu-card" data-category="popular">
                <div class="badge popular">Populer</div>
                <img src="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 400 250'><rect fill='%23f8f9fa' width='400' height='250'/><circle cx='200' cy='125' r='60' fill='%2327ae60'/><text x='200' y='135' text-anchor='middle' fill='white' font-size='14' font-weight='bold'>Chicken Katsu</text></svg>" alt="Chicken Katsu Ramen" class="card-image">
                <div class="card-content">
                    <h3 class="card-title">Chicken Katsu Ramen</h3>
                    <div class="rating">
                        <span class="stars">★★★★☆</span>
                        <span class="rating-text">(4.6) 112 reviews</span>
                    </div>
                    <p class="card-description">Kombinasi sempurna ramen dengan chicken katsu renyah, telur setengah matang, dan sayuran hijau segar.</p>
                    <div class="ingredients">
                        <span class="ingredient-tag">Chicken Katsu</span>
                        <span class="ingredient-tag">Soft Egg</span>
                        <span class="ingredient-tag">Bok Choy</span>
                        <span class="ingredient-tag">Green Onion</span>
                    </div>
                    <div class="card-price">Rp 48.000</div>
                    <button class="card-button">Pesan Sekarang</button>
                </div>
            </div>

            <div class="menu-card" data-category="traditional">
                <img src="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 400 250'><rect fill='%23f8f9fa' width='400' height='250'/><circle cx='200' cy='125' r='60' fill='%23e67e22'/><text x='200' y='135' text-anchor='middle' fill='white' font-size='16' font-weight='bold'>Tonkotsu</text></svg>" alt="Tonkotsu Ramen" class="card-image">
                <div class="card-content">
                    <h3 class="card-title">Tonkotsu Ramen</h3>
                    <div class="rating">
                        <span class="stars">★★★★★</span>
                        <span class="rating-text">(4.9) 203 reviews</span>
                    </div>
                    <p class="card-description">Kuah tulang sapi yang dimasak 20 jam hingga creamy, dengan chashu melt-in-mouth dan bamboo shoots.</p>
                    <div class="ingredients">
                        <span class="ingredient-tag">Rich Broth</span>
                        <span class="ingredient-tag">Melt Chashu</span>
                        <span class="ingredient-tag">Bamboo Shoots</span>
                        <span class="ingredient-tag">Soft Egg</span>
                    </div>
                    <div class="card-price">Rp 55.000</div>
                    <button class="card-button">Pesan Sekarang</button>
                </div>
            </div>

            <div class="menu-card" data-category="spicy new">
                <div class="badge new">Baru</div>
                <img src="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 400 250'><rect fill='%23f8f9fa' width='400' height='250'/><circle cx='200' cy='125' r='60' fill='%23e74c3c'/><text x='200' y='135' text-anchor='middle' fill='white' font-size='14' font-weight='bold'>Tantanmen</text></svg>" alt="Tantanmen Ramen" class="card-image">
                <div class="card-content">
                    <h3 class="card-title">Tantanmen Ramen</h3>
                    <div class="rating">
                        <span class="stars">★★★★☆</span>
                        <span class="rating-text">(4.5) 76 reviews</span>
                    </div>
                    <p class="card-description">Ramen fusion Jepang-China dengan kuah sesame pedas, daging cincang, dan sayuran Asia yang autentik.</p>
                    <div class="ingredients">
                        <span class="ingredient-tag">Sesame Broth</span>
                        <span class="ingredient-tag">Ground Meat</span>
                        <span class="ingredient-tag">Bok Choy</span>
                        <span class="ingredient-tag">Spicy Oil</span>
                    </div>
                    <div class="card-price">Rp 50.000</div>
                    <button class="card-button">Pesan Sekarang</button>
                </div>
            </div>
        </section>
    </main>

    <!-- Modal -->
    <div id="orderModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <img id="modalImage" src="" alt="" class="modal-image">
                <button class="close-btn">&times;</button>
            </div>
            <div class="modal-body">
                <h2 id="modalTitle"></h2>
                <p id="modalDescription"></p>
                <div id="modalPrice" class="card-price"></div>
                <button class="card-button" style="margin-top: 20px;">Konfirmasi Pesanan</button>
            </div>
        </div>
    </div>

    <script>
        // Filter functionality
        const filterButtons = document.querySelectorAll('.filter-btn');
        const menuCards = document.querySelectorAll('.menu-card');

        filterButtons.forEach(button => {
            button.addEventListener('click', () => {
                // Remove active class from all buttons
                filterButtons.forEach(btn => btn.classList.remove('active'));
                // Add active class to clicked button
                button.classList.add('active');

                const filter = button.dataset.filter;

                menuCards.forEach(card => {
                    if (filter === 'all') {
                        card.style.display = 'block';
                        card.style.animation = 'fadeIn 0.5s ease-in';
                    } else {
                        if (card.dataset.category.includes(filter)) {
                            card.style.display = 'block';
                            card.style.animation = 'fadeIn 0.5s ease-in';
                        } else {
                            card.style.display = 'none';
                        }
                    }
                });
            });
        });

        // Modal functionality
        const modal = document.getElementById('orderModal');
        const orderButtons = document.querySelectorAll('.card-button');
        const closeBtn = document.querySelector('.close-btn');

        orderButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                const card = button.closest('.menu-card');
                const title = card.querySelector('.card-title').textContent;
                const description = card.querySelector('.card-description').textContent;
                const price = card.querySelector('.card-price').textContent;
                const image = card.querySelector('.card-image').src;

                document.getElementById('modalTitle').textContent = title;
                document.getElementById('modalDescription').textContent = description;
                document.getElementById('modalPrice').textContent = price;
                document.getElementById('modalImage').src = image;

                modal.style.display = 'block';
                document.body.style.overflow = 'hidden';
            });
        });

        // Close modal
        closeBtn.addEventListener('click', closeModal);
        window.addEventListener('click', (e) => {
            if (e.target === modal) {
                closeModal();
            }
        });

        function closeModal() {
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        // Add fade-in animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(20px); }
                to { opacity: 1; transform: translateY(0); }
            }
        `;
        document.head.appendChild(style);

        // Smooth scroll for navigation
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

        // Add loading animation to buttons
        orderButtons.forEach(button => {
            button.addEventListener('click', () => {
                if (!button.textContent.includes('Konfirmasi')) {
                    button.style.background = 'linear-gradient(135deg, #27ae60, #2ecc71)';
                    button.textContent = 'Ditambahkan ✓';
                    setTimeout(() => {
                        button.style.background = 'linear-gradient(135deg, #e74c3c, #c0392b)';
                        button.textContent = 'Pesan Sekarang';
                    }, 1500);
                }
            });
        });
    </script>
</body>
</html>