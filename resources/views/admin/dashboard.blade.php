<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Stok ve Sipariş Yönetimi</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Figtree', sans-serif;
        }

        .navbar {
            background-color: #f8f9fa;
        }

        .navbar-brand {
            font-weight: 600;
            color: #2d3748;
        }

        .nav-link {
            color: #4a5568;
        }

        .nav-link:hover {
            color: #1a202c;
        }

        .btn-primary {
            background-color: #4299e1;
            border-color: #4299e1;
        }

        .btn-primary:hover {
            background-color: #3182ce;
            border-color: #3182ce;
        }

        .btn-success {
            background-color: #48bb78;
            border-color: #48bb78;
        }

        .btn-success:hover {
            background-color: #38a169;
            border-color: #38a169;
        }
    </style>
</head>

<body class="antialiased">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="/">Stok ve Sipariş Yönetimi</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="GET" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>

        </div>
    </nav>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Stok Yönetimi</h5>
                        <p class="card-text">Stoklarınızı kolayca yönetin, yeni ürünler ekleyin ve mevcut ürünleri
                            güncelleyin.</p>
                        <a href="{{ route('admin.stok') }}" class="btn btn-primary">Stokları Görüntüle</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Sipariş Yönetimi</h5>
                        <p class="card-text">Siparişlerinizi takip edin, yeni siparişler oluşturun ve müşteri
                            bilgilerini yönetin.</p>
                        <a href="{{ route('admin.siparis') }}" class="btn btn-success">Siparişleri Görüntüle</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="mt-5 py-4 bg-light">
        <div class="container text-center">
            <p class="mb-0">Stok ve Sipariş Yönetimi &copy; {{ date('Y') }}</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>