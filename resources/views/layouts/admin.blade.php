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
            --primary-color: #212121;
            --secondary-color: #BFA850;
            --background-color: #FAFAFA;
            --text-color: #212121;
            --white: #FFFFFF;
            --cream: #FDF6E3;
            --light-gray: #EEEEEE;
            --border-color: #E0E0E0;
        }

        body {
            background-color: var(--background-color);
            color: var(--text-color);
            font-family: 'Inter', sans-serif;
        }

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
            font-weight: 600;
            border-radius: 8px 8px 0 0 !important;
            padding: 1.2rem;
        }

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
        }

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

        .badge {
            padding: 0.5em 1em;
            font-weight: 500;
            border-radius: 4px;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        .sidebar {
            background-color: var(--primary-color);
            min-height: 100vh;
            padding: 1rem;
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            font-weight: 500;
            padding: 0.5rem 1rem;
            margin: 0.2rem 0;
            border-radius: 0.25rem;
            transition: all 0.3s ease;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: white;
            background-color: var(--secondary-color);
        }

        .sidebar .nav-link i {
            margin-right: 0.5rem;
        }

        .main-content {
            padding: 2rem;
        }

        .card {
            border: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }

        .table th {
            font-weight: 600;
        }
    </style>
    @yield('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-couch me-2"></i>
                Vinzz Furniture - Admin
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link{{ request()->routeIs('admin.dashboard') ? ' active' : '' }}" href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link{{ request()->routeIs('admin.products.*') ? ' active' : '' }}" href="{{ route('admin.products.index') }}">
                            <i class="fas fa-box"></i> Produk
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link{{ request()->routeIs('admin.categories.*') ? ' active' : '' }}" href="{{ route('admin.categories.index') }}">
                            <i class="fas fa-tags"></i> Kategori
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link{{ request()->routeIs('admin.orders.*') ? ' active' : '' }}" href="{{ route('admin.orders.index') }}">
                            <i class="fas fa-shopping-cart"></i> Pesanan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link{{ request()->routeIs('admin.customers.*') ? ' active' : '' }}" href="{{ route('admin.customers.index') }}">
                            <i class="fas fa-users"></i> Customer
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

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

    <!-- Page Content -->
    <main>
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html> 