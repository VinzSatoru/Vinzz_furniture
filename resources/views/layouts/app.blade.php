@php
use App\Models\Cart;
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts - Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            /* Primary Colors */
            --primary-color: #212121;      /* Dark Black */
            --secondary-color: #BFA850;    /* Elegant Gold */
            --accent-color: #1A237E;       /* Deep Navy */
            
            /* Neutral Colors */
            --background-color: #FAFAFA;   /* Cream White */
            --text-color: #212121;         /* Dark Black */
            --light-text: #757575;         /* Gray */
            
            /* UI Colors */
            --white: #FFFFFF;
            --cream: #FDF6E3;
            --light-gray: #EEEEEE;
            --border-color: #E0E0E0;
            
            /* Status Colors */
            --success-color: #2E7D32;      /* Dark Green */
            --warning-color: #F9A825;      /* Gold Yellow */
            --danger-color: #C62828;       /* Dark Red */
            --info-color: #1565C0;         /* Dark Blue */
        }

        body {
            background-color: var(--background-color);
            color: var(--text-color);
            font-family: 'Poppins', sans-serif;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
        }

        /* Navbar Styling */
        .navbar {
            background-color: var(--primary-color);
            padding: 1rem 0;
        }

        .navbar-brand {
            color: var(--secondary-color) !important;
            font-weight: 700;
            font-size: 1.5rem;
        }

        .nav-link {
            color: var(--white) !important;
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            color: var(--secondary-color) !important;
        }

        .nav-link.active {
            color: var(--secondary-color) !important;
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .dropdown-item {
            padding: 0.5rem 1rem;
            transition: all 0.3s ease;
        }

        .dropdown-item:hover {
            background-color: var(--light-gray);
            color: var(--primary-color);
        }

        .btn-link {
            color: var(--text-color);
            text-decoration: none;
            padding: 0.5rem 1rem;
        }

        .btn-link:hover {
            color: var(--secondary-color);
        }

        .cart-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: var(--danger-color);
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Button Styling */
        .btn {
            padding: 0.8rem 1.5rem;
            font-weight: 500;
            border-radius: 4px;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: var(--secondary-color);
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            color: var(--primary-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        .btn-secondary {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            color: var(--primary-color);
        }

        .btn-secondary:hover {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        /* Card Styling */
        .card {
            border: none;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            background-color: var(--cream);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0,0,0,0.2);
        }

        .card-header {
            background-color: var(--primary-color);
            color: var(--secondary-color);
            font-family: 'Playfair Display', serif;
            font-weight: 600;
            border-radius: 8px 8px 0 0 !important;
            padding: 1.2rem;
        }

        /* Product Card */
        .product-card {
            border: none;
            background-color: var(--cream);
            transition: all 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
        }

        .product-card .card-img-top {
            height: 250px;
            object-fit: cover;
            border-radius: 8px 8px 0 0;
        }

        .product-card .card-title {
            color: var(--primary-color);
            font-family: 'Playfair Display', serif;
            font-weight: 600;
            font-size: 1.4rem;
        }

        .product-card .price {
            color: var(--secondary-color);
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 1.5rem;
        }

        /* Form Styling */
        .form-control {
            border: 1px solid var(--border-color);
            border-radius: 4px;
            padding: 0.8rem;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.2rem rgba(191, 168, 80, 0.25);
        }

        /* Footer Styling */
        footer {
            background-color: var(--primary-color);
            color: var(--white);
            padding: 4rem 0 2rem;
            margin-top: 4rem;
        }

        footer h5 {
            color: var(--secondary-color);
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        footer a {
            color: var(--white);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        footer a:hover {
            color: var(--secondary-color);
        }

        .social-links a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: rgba(255,255,255,0.1);
            color: var(--secondary-color);
            margin-right: 1rem;
            transition: all 0.3s ease;
        }

        .social-links a:hover {
            background-color: var(--secondary-color);
            color: var(--primary-color);
        }

        /* Badge Styling */
        .badge {
            padding: 0.5em 1em;
            font-weight: 500;
            border-radius: 4px;
        }

        /* Alert Styling */
        .alert {
            border: none;
            border-radius: 8px;
            padding: 1rem 1.5rem;
        }

        /* Table Styling */
        .table {
            background-color: var(--white);
            border-radius: 8px;
            overflow: hidden;
        }

        .table thead th {
            background-color: var(--primary-color);
            color: var(--secondary-color);
            font-weight: 600;
            padding: 1rem;
            border: none;
        }

        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
            border-color: var(--border-color);
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--light-gray);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary-color);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--secondary-color);
        }

        /* Hero Section */
        .hero-section {
            height: 100vh;
            background-size: cover;
            background-position: center;
            position: relative;
            display: flex;
            align-items: center;
            color: var(--white);
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.7));
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        .hero-title {
            font-family: 'Poppins', sans-serif;
            font-size: 4rem;
            font-weight: 700;
            color: var(--white);
            margin-bottom: 1.5rem;
        }

        .hero-subtitle {
            font-family: 'Poppins', sans-serif;
            font-size: 1.5rem;
            color: var(--secondary-color);
            margin-bottom: 2rem;
        }

        /* Section Styling */
        .section-title {
            font-family: 'Poppins', sans-serif;
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 2rem;
            text-align: center;
        }

        .section-subtitle {
            font-family: 'Poppins', sans-serif;
            color: var(--secondary-color);
            font-size: 1.2rem;
            text-align: center;
            margin-bottom: 3rem;
        }

        /* Feature Box */
        .feature-box {
            text-align: center;
            padding: 2rem;
            transition: all 0.3s ease;
        }

        .feature-box:hover {
            transform: translateY(-10px);
        }

        .feature-icon {
            font-size: 3rem;
            color: var(--secondary-color);
            margin-bottom: 1.5rem;
        }

        .feature-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .feature-text {
            color: var(--light-text);
            line-height: 1.6;
        }
    </style>
    @yield('styles')
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <i class="fas fa-couch me-2"></i>
                    Vinzz Furniture
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link{{ request()->routeIs('home') ? ' active' : '' }}" href="{{ route('home') }}">
                                Beranda
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link{{ request()->routeIs('products.*') ? ' active' : '' }}" href="{{ route('products.index') }}">
                                Produk
                            </a>
                        </li>
                        @auth
                            @if(auth()->user()->isAdmin())
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-cog"></i> Admin Panel
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                            <i class="fas fa-tachometer-alt"></i> Dashboard
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.products.index') }}">
                                            <i class="fas fa-box"></i> Kelola Produk
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.categories.index') }}">
                                            <i class="fas fa-tags"></i> Kelola Kategori
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.orders.index') }}">
                                            <i class="fas fa-shopping-cart"></i> Kelola Pesanan
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.customers.index') }}">
                                            <i class="fas fa-users"></i> Kelola Customer
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            @endif
                        @endauth
                        <li class="nav-item">
                            <a class="nav-link{{ request()->routeIs('about') ? ' active' : '' }}" href="{{ route('about') }}">
                                Tentang Kami
                            </a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        @auth
                            @if(auth()->user()->isAdmin())
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.*') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                                        <i class="fas fa-tachometer-alt me-1"></i> Admin Dashboard
                                    </a>
                                </li>
                            @endif

                            @if(auth()->user()->isCustomer())
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('orders.*') ? 'active' : '' }}" href="{{ route('orders.index') }}">
                                        <i class="fas fa-shopping-bag me-1"></i> Pesanan Saya
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('cart.*') ? 'active' : '' }}" href="{{ route('cart.index') }}">
                                        <i class="fas fa-shopping-cart me-1"></i> Keranjang
                                        @php
                                            $cart = Session::get('cart', []);
                                            $cartCount = array_sum(array_column($cart, 'quantity'));
                                        @endphp
                                        @if($cartCount > 0)
                                            <span class="badge bg-danger rounded-pill">{{ $cartCount }}</span>
                                        @endif
                                    </a>
                                </li>
                            @endif

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-user me-1"></i> {{ auth()->user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                            <i class="fas fa-user-cog me-1"></i> Profile
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="dropdown-item">
                                                <i class="fas fa-sign-out-alt me-1"></i> Logout
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}" href="{{ route('login') }}">
                                    <i class="fas fa-sign-in-alt me-1"></i> Login
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('register') ? 'active' : '' }}" href="{{ route('register') }}">
                                    <i class="fas fa-user-plus me-1"></i> Register
                                </a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="container mt-3">
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="container mt-3">
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            </div>
        @endif

        @if(session('info'))
            <div class="container mt-3">
                <div class="alert alert-info">
                    {{ session('info') }}
                </div>
            </div>
        @endif

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>
    </div>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5>Vinzz Furniture</h5>
                    <p>Menyediakan furniture berkualitas dengan desain modern dan klasik untuk hunian nyaman Anda.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <h5>Kontak</h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-map-marker-alt me-2"></i> Jl. Sunan Mantingan,Tahunan,Jepara</li>
                        <li><i class="fas fa-phone me-2"></i> (+62) 857-4145-8614</li>
                        <li><i class="fas fa-envelope me-2"></i> vinzzfurniture@gmail.com</li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h5>Ikuti Kami</h5>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            <hr class="mt-4 mb-4" style="border-color: rgba(255,255,255,0.1);">
            <div class="text-center">
                <p class="mb-0">&copy; {{ date('Y') }} Vinzz Furniture. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html> 