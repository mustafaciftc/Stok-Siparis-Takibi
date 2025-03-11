<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stok ve Sipariş Sistemi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <style>
        .navbar {
            background-color: #2c3e50;
        }

        .navbar-brand,
        .nav-link {
            color: white !important;
        }

        .nav-link:hover {
            color: #3498db !important;
        }

        .product-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            height: 100%;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .product-image-container {
            height: 220px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
            border-radius: 10px;
            overflow: hidden;
            padding: 10px;
        }

        .product-image-container img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            transition: transform 0.3s ease-in-out;
        }

        .product-image-container img:hover {
            transform: scale(1.1);
            filter: brightness(1.1);
        }

        .product-details {
            padding: 1.5rem;
        }

        .product-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 0.75rem;
            height: 2.8rem;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        .price-tag {
            color: #2c3e50;
            font-weight: 700;
            font-size: 1.5rem;
            margin-bottom: 0.75rem;
        }

        .stock-info {
            background-color: #e9ecef;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.9rem;
            color: #495057;
            display: inline-block;
            margin-bottom: 1rem;
        }

        .add-to-cart-btn {
            background-color: #3498db;
            border: none;
            padding: 12px 24px;
            font-weight: 500;
            transition: all 0.3s ease;
            color: white;
            width: 100%;
            border-radius: 8px;
        }

        .add-to-cart-btn:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
        }

        .add-to-cart-btn:disabled {
            background-color: #95a5a6;
            cursor: not-allowed;
        }

        .filter-section {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .filter-section h5 {
            font-size: 1.25rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 15px;
        }

        .filter-section .form-control {
            border-radius: 8px;
            border: 1px solid #ced4da;
            padding: 10px;
        }

        .filter-section .btn {
            border-radius: 8px;
            padding: 10px 20px;
            font-weight: 500;
        }

        .filter-section .btn-primary {
            background-color: #3498db;
            border: none;
        }

        .filter-section .btn-primary:hover {
            background-color: #2980b9;
        }

        .hero-section {
            background: linear-gradient(135deg, #3498db, #2c3e50);
            padding: 50px 0;
            color: white;
            border-radius: 12px;
            margin: 30px;
        }

        .hero-section h1 {
            font-size: 3.5rem;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .hero-section p {
            font-size: 1.25rem;
            font-weight: 300;
            margin-bottom: 40px;
        }

        .hero-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background-color: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .hero-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .hero-card h5 {
            color: #2c3e50;
            font-weight: 600;
        }

        .hero-card p {
            color: #495057;
            font-size: 0.9rem;
        }

        .hero-section .btn {
            font-size: 1.1rem;
            padding: 12px 30px;
            border-radius: 30px;
        }

        .footer {
            background-color: #2c3e50;
            color: white;
            padding: 50px 0;
            margin-top: 50px;
        }

        .footer a {
            color: white;
            text-decoration: none;
        }

        .footer a:hover {
            color: #3498db;
        }

        .footer .social-icons a {
            font-size: 1.5rem;
            margin: 0 10px;
        }

        .filter-section {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .filter-section .form-range {
            width: 100%;
            height: 10px;
            border-radius: 5px;
            background: #ddd;
            outline: none;
            opacity: 0.7;
            transition: opacity 0.2s;
        }

        .filter-section .form-range:hover {
            opacity: 1;
        }

        .filter-section .form-range::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #3498db;
            cursor: pointer;
        }

        .filter-section .form-range::-moz-range-thumb {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #3498db;
            cursor: pointer;
        }

        .filter-section label {
            font-size: 0.9rem;
            font-weight: 500;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .filter-section .price-values {
            font-size: 0.9rem;
            color: #495057;
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg mb-4">
        <div class="container">
            <a class="navbar-brand" href="/">Stok ve Sipariş Sistemi</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#urunler">Ürünler</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('cart') }}">Sepetim</a>
                        </li>

                        @if(Auth::user()->role == 1)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.dashboard') }}">Admin Paneli</a>
                            </li>
                        @endif

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}">Çıkış Yap</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Giriş Yap</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Kayıt Ol</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section mb-5">
        <div class="container text-center">
            <h1 class="display-4 mb-4">Elektronik Dünyasına Hoş Geldiniz!</h1>
            <p class="lead mb-4">En yeni teknolojik ürünler, uygun fiyatlarla sizlerle. Hemen keşfedin!</p>
            <div class="row g-4 justify-content-center">
                <div class="col-md-3">
                    <div class="hero-card bg-white p-4 rounded-3 shadow-sm">
                        <i class="bi bi-phone" style="font-size: 2.5rem; color: #3498db;"></i>
                        <h5 class="mt-3">Akıllı Telefonlar</h5>
                        <p class="text-muted">En yeni modeller, uygun fiyatlarla.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="hero-card bg-white p-4 rounded-3 shadow-sm">
                        <i class="bi bi-laptop" style="font-size: 2.5rem; color: #3498db;"></i>
                        <h5 class="mt-3">Dizüstü Bilgisayarlar</h5>
                        <p class="text-muted">Yüksek performans, taşınabilirlik.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="hero-card bg-white p-4 rounded-3 shadow-sm">
                        <i class="bi bi-headphones" style="font-size: 2.5rem; color: #3498db;"></i>
                        <h5 class="mt-3">Kulaklıklar</h5>
                        <p class="text-muted">Ses kalitesi ve konfor bir arada.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="hero-card bg-white p-4 rounded-3 shadow-sm">
                        <i class="bi bi-smartwatch" style="font-size: 2.5rem; color: #3498db;"></i>
                        <h5 class="mt-3">Akıllı Saatler</h5>
                        <p class="text-muted">Sağlık ve teknoloji bir arada.</p>
                    </div>
                </div>
            </div>
            @auth
                <a href="#urunler" class="btn btn-light btn-lg mt-5">Ürünlere Gözat</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-light btn-lg mt-5">Giriş Yap</a>
            @endauth
        </div>
    </section>

    <!-- Ürünler Section -->
    <section id="urunler" class="container mb-5">
        <h2 class="text-center mb-4">Ürünlerimiz</h2>

        <!-- Filtreleme Alanı -->
        <div class="filter-section">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <label for="minPriceRange" class="form-label">Min Fiyat: <span id="minPriceDisplay">0
                            ₺</span></label>
                    <input type="range" id="minPriceRange" class="form-range" min="0" max="50000" step="1000" value="0">
                </div>
                <div class="col-md-6">
                    <label for="maxPriceRange" class="form-label">Max Fiyat: <span id="maxPriceDisplay">50000
                            ₺</span></label>
                    <input type="range" id="maxPriceRange" class="form-range" min="0" max="50000" step="1000"
                        value="50000">
                </div>
                <div class="col-md-12 text-center mt-3">
                    <button class="btn btn-primary" onclick="filterProducts()">
                        <i class="bi bi-funnel"></i> Filtrele
                    </button>
                </div>
            </div>
        </div>

        <!-- Ürünler -->
        <div class="row g-4">
            @foreach($stoklar as $stok)
                <div class="col-md-4">
                    <div class="card product-card">
                        <div class="product-image-container">
                            @if($stok->img)
                                <img src="{{ asset('storage/' . $stok->img) }}" alt="{{ $stok->urun_adi }}"
                                    class="card-img-top w-80 h-80">
                            @else
                                <div class="d-flex align-items-center justify-content-center h-50 w-50">
                                    <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                                </div>
                            @endif
                        </div>
                        <div class="product-details">
                            <h5 class="product-title">{{ $stok->urun_adi }}</h5>
                            <div class="price-tag">{{ number_format($stok->fiyat, 2) }} ₺</div>
                            <div class="stock-info">
                                <i class="bi bi-box-seam me-1"></i>
                                Stok: {{ $stok->miktar }} adet
                            </div>
                            @auth
                                <form action="{{ route('add.to.cart', $stok->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn add-to-cart-btn" {{ $stok->miktar <= 0 ? 'disabled' : '' }}>
                                        @if($stok->miktar <= 0)
                                            <i class="bi bi-x-circle me-1"></i> Stokta Yok
                                        @else
                                            <i class="bi bi-cart-plus me-1"></i> Sepete Ekle
                                        @endif
                                    </button>
                                </form>
                            @else
                                <button class="btn add-to-cart-btn" disabled>
                                    <i class="bi bi-lock me-1"></i> Giriş Yap
                                </button>
                            @endauth
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 text-center">
                    <h5>Hızlı Erişim</h5>
                    <ul class="list-unstyled">
                        <li><a href="#urunler">Ürünler</a></li>
                        <li><a href="{{ route('cart') }}">Sepetim</a></li>
                        <li><a href="{{ route('login') }}">Giriş Yap</a></li>
                        <li><a href="{{ route('register') }}">Kayıt Ol</a></li>
                    </ul>
                </div>
                <div class="col-md-4 text-center">
                    <h5>İletişim</h5>
                    <p>Email: info@stoksiparis.com</p>
                    <p>Telefon: +90 123 456 78 90</p>
                </div>
                <div class="col-md-4 text-center">
                    <h5>Sosyal Medya</h5>
                    <div class="social-icons">
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-github"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12 text-center">
                    <p class="mb-0">© {{ date('Y') }} Stok ve Sipariş Sistemi. Tüm hakları saklıdır.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const minPriceRange = document.getElementById('minPriceRange');
        const maxPriceRange = document.getElementById('maxPriceRange');
        const minPriceDisplay = document.getElementById('minPriceDisplay');
        const maxPriceDisplay = document.getElementById('maxPriceDisplay');

        // Min fiyat slider'ını dinle
        minPriceRange.addEventListener('input', () => {
            minPriceDisplay.textContent = `${minPriceRange.value} ₺`;
            // Min fiyat, max fiyattan büyük olamaz
            if (parseInt(minPriceRange.value) > parseInt(maxPriceRange.value)) {
                maxPriceRange.value = minPriceRange.value;
                maxPriceDisplay.textContent = `${maxPriceRange.value} ₺`;
            }
        });

        // Max fiyat slider'ını dinle
        maxPriceRange.addEventListener('input', () => {
            maxPriceDisplay.textContent = `${maxPriceRange.value} ₺`;
            // Max fiyat, min fiyattan küçük olamaz
            if (parseInt(maxPriceRange.value) < parseInt(minPriceRange.value)) {
                minPriceRange.value = maxPriceRange.value;
                minPriceDisplay.textContent = `${minPriceRange.value} ₺`;
            }
        });

        // Filtreleme işlemi
        function filterProducts() {
            const minPrice = parseFloat(minPriceRange.value);
            const maxPrice = parseFloat(maxPriceRange.value);
            const products = document.querySelectorAll('.product-card');

            products.forEach(product => {
                const price = parseFloat(product.querySelector('.price-tag').innerText.replace('₺', '').replace(',', '').trim());
                if (price >= minPrice && price <= maxPrice) {
                    product.style.display = 'block';
                } else {
                    product.style.display = 'none';
                }
            });
        }
        function addToCart(id, name) {
            alert(name + " sepete eklendi!");
            const select = document.getElementById('stok_id');
            select.value = id;
            document.getElementById('siparis').scrollIntoView({ behavior: 'smooth' });
        }
    </script>
</body>

</html>