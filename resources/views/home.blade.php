@extends('layouts.app')

@section('title', 'Beranda')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<style>
    @font-face {
        font-family: 'Poppins';
        src: url('https://fonts.gstatic.com/s/poppins/v20/pxiEyp8kv8JHgFVrJJfecg.woff2') format('woff2');
        font-weight: normal;
        font-style: normal;
        font-display: swap;
    }

    @font-face {
        font-family: 'Poppins';
        src: url('https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLCz7Z1xlFQ.woff2') format('woff2');
        font-weight: 600;
        font-style: normal;
        font-display: swap;
    }

    @font-face {
        font-family: 'Poppins';
        src: url('https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLGT9Z1xlFQ.woff2') format('woff2');
        font-weight: 700;
        font-style: normal;
        font-display: swap;
    }

    :root {
        --font-poppins: 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    }

    /* Global Styles */
    * {
        font-family: var(--font-poppins) !important;
    }

    /* Override Bootstrap Card Styles */
    .card,
    .card *,
    .card-body,
    .card-title,
    .card-text,
    .btn,
    .btn-primary,
    .btn-lg,
    .feature-title,
    .feature-text,
    .feature-stat,
    .feature-desc,
    .section-title,
    .section-subtitle,
    .product-card .card-title,
    .product-card .price,
    .product-card .btn {
        font-family: 'Poppins', sans-serif !important;
    }

    /* Features Section Styling */
    .features-section {
        background: linear-gradient(135deg, 
            rgba(255, 255, 255, 0.95) 0%,
            rgba(255, 255, 255, 0.98) 100%
        );
        position: relative;
        overflow: hidden;
        padding: 5rem 0;
    }

    .features-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23bfa850' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        opacity: 0.5;
    }

    .feature-box {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 2.5rem 2rem;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(191, 168, 80, 0.1);
        position: relative;
        overflow: hidden;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .feature-box::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, 
            var(--secondary-color) 0%,
            var(--primary-color) 100%
        );
        transform: scaleX(0);
        transition: transform 0.4s ease;
    }

    .feature-box:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }

    .feature-box:hover::before {
        transform: scaleX(1);
    }

    .feature-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg,
            var(--secondary-color) 0%,
            var(--primary-color) 100%
        );
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.5rem;
        color: var(--white);
        font-size: 2rem;
        transition: all 0.4s ease;
        position: relative;
        z-index: 1;
    }

    .feature-icon::after {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background: inherit;
        z-index: -1;
        filter: blur(10px);
        opacity: 0.5;
        transition: all 0.4s ease;
    }

    .feature-box:hover .feature-icon {
        transform: scale(1.1) rotate(5deg);
    }

    .feature-box:hover .feature-icon::after {
        transform: scale(1.2);
        opacity: 0.8;
    }

    /* Feature Title Specific Styling */
    .feature-box h3.feature-title {
        font-family: 'Poppins', sans-serif !important;
        font-weight: 600 !important;
        font-size: 1.5rem;
        color: var(--primary-color);
        margin-bottom: 1rem;
        position: relative;
        font-style: normal !important;
        text-transform: none !important;
        letter-spacing: normal !important;
        line-height: 1.4 !important;
    }

    .feature-text {
        font-family: var(--font-poppins) !important;
        font-weight: 400 !important;
        font-size: 1rem;
        color: var(--light-text);
        line-height: 1.6;
        margin-bottom: 1.5rem;
    }

    .feature-hover-content {
        margin-top: auto;
        padding-top: 1rem;
        border-top: 1px solid rgba(191, 168, 80, 0.1);
        width: 100%;
    }

    .feature-stat {
        display: block;
        font-family: var(--font-poppins) !important;
        font-weight: 700 !important;
        font-size: 1.8rem;
        color: var(--secondary-color);
        margin-bottom: 0.5rem;
    }

    .feature-desc {
        display: block;
        font-family: var(--font-poppins) !important;
        font-weight: 500 !important;
        font-size: 0.9rem;
        color: var(--light-text);
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* Featured Products Section Styling */
    .section-title {
        font-family: 'Poppins', sans-serif !important;
        font-weight: 600 !important;
        font-size: 2rem;
        color: var(--primary-color);
        margin-bottom: 1rem;
        text-align: center;
    }

    .section-subtitle {
        font-family: 'Poppins', sans-serif !important;
        font-weight: 400 !important;
        font-size: 1.1rem;
        color: var(--light-text);
        text-align: center;
        margin-bottom: 2rem;
    }

    /* Product Card Specific Styling */
    .product-card {
        font-family: 'Poppins', sans-serif !important;
    }

    .product-card .card-body {
        font-family: 'Poppins', sans-serif !important;
    }

    .product-card .card-title {
        font-family: 'Poppins', sans-serif !important;
        font-weight: 600 !important;
        font-size: 1.2rem;
        color: var(--primary-color);
        margin-bottom: 0.5rem;
    }

    .product-card .price {
        font-family: 'Poppins', sans-serif !important;
        font-weight: 700 !important;
        font-size: 1.1rem;
        color: var(--secondary-color);
        margin-bottom: 1rem;
    }

    .product-card .btn {
        font-family: 'Poppins', sans-serif !important;
        font-weight: 500 !important;
    }

    /* Override Bootstrap Button Styles */
    .btn,
    .btn-primary,
    .btn-lg {
        font-family: 'Poppins', sans-serif !important;
    }

    @media (max-width: 768px) {
        .feature-box {
            padding: 2rem 1.5rem;
        }

        .feature-icon {
            width: 70px;
            height: 70px;
            font-size: 1.8rem;
        }

        .feature-title {
            font-size: 1.3rem;
        }

        .feature-text {
            font-size: 0.9rem;
        }

        .feature-stat {
            font-size: 1.5rem;
        }

        .section-title {
            font-size: 1.8rem;
        }

        .section-subtitle {
            font-size: 1rem;
        }
    }
</style>
@endpush

@section('content')
    <!-- Hero Section -->
    <section class="hero-section" style="background-image: url('{{ asset('storage/images/hero-bg.jpg') }}');">
        <div class="hero-overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="hero-content">
                        <h1 class="hero-title animate__animated animate__fadeInDown" style="font-family: 'Poppins', sans-serif !important;">
                            Temukan Furniture Berkualitas untuk Rumah Impian Anda
                        </h1>
                        <p class="hero-subtitle animate__animated animate__fadeInUp" style="font-family: 'Poppins', sans-serif !important;">
                            Desain modern dan klasik untuk hunian yang nyaman dan elegan
                        </p>
                        <div class="hero-buttons animate__animated animate__fadeInUp animate__delay-1s">
                            <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg me-3" style="font-family: 'Poppins', sans-serif !important;">
                                Jelajahi Koleksi
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5 features-section">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-box animate__animated animate__fadeIn">
                        <div class="feature-icon">
                            <i class="fas fa-truck-fast"></i>
                        </div>
                        <h3 class="feature-title" style="font-family: 'Poppins', sans-serif !important;">Pengiriman Cepat</h3>
                        <p class="feature-text" style="font-family: 'Poppins', sans-serif !important;">Layanan pengiriman cepat ke seluruh Indonesia dengan penanganan khusus dan tracking real-time</p>
                        <div class="feature-hover-content">
                            <span class="feature-stat" style="font-family: 'Poppins', sans-serif !important;">24-48 Jam</span>
                            <span class="feature-desc" style="font-family: 'Poppins', sans-serif !important;">Waktu Pengiriman</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box animate__animated animate__fadeIn animate__delay-1s">
                        <div class="feature-icon">
                            <i class="fas fa-award"></i>
                        </div>
                        <h3 class="feature-title" style="font-family: 'Poppins', sans-serif !important;">Kualitas Terjamin</h3>
                        <p class="feature-text" style="font-family: 'Poppins', sans-serif !important;">Produk berkualitas tinggi dengan bahan pilihan dan pengerjaan profesional oleh tim ahli</p>
                        <div class="feature-hover-content">
                            <span class="feature-stat" style="font-family: 'Poppins', sans-serif !important;">100%</span>
                            <span class="feature-desc" style="font-family: 'Poppins', sans-serif !important;">Garansi Kualitas</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box animate__animated animate__fadeIn animate__delay-2s">
                        <div class="feature-icon">
                            <i class="fas fa-headset"></i>
                        </div>
                        <h3 class="feature-title" style="font-family: 'Poppins', sans-serif !important;">Layanan 24/7</h3>
                        <p class="feature-text" style="font-family: 'Poppins', sans-serif !important;">Dukungan pelanggan 24/7 untuk membantu Anda kapan saja dengan respon cepat</p>
                        <div class="feature-hover-content">
                            <span class="feature-stat" style="font-family: 'Poppins', sans-serif !important;">24/7</span>
                            <span class="feature-desc" style="font-family: 'Poppins', sans-serif !important;">Customer Support</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="section-title" style="font-family: 'Poppins', sans-serif !important;">Produk Unggulan</h2>
            <p class="section-subtitle" style="font-family: 'Poppins', sans-serif !important;">Koleksi terbaik kami untuk hunian Anda</p>
            <div class="row g-4">
                @foreach($featuredProducts as $product)
                <div class="col-md-3">
                    <div class="card product-card animate__animated animate__fadeIn">
                        <img src="{{ asset('storage/' . $product->image  ) }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h5 class="card-title" style="font-family: 'Poppins', sans-serif !important;">{{ $product->name }}</h5>
                            <p class="price" style="font-family: 'Poppins', sans-serif !important;">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            <div class="d-grid">
                                <a href="{{ route('products.show', $product) }}" class="btn btn-primary" style="font-family: 'Poppins', sans-serif !important;">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="section-title" style="font-family: 'Poppins', sans-serif !important;">Apa Kata Mereka</h2>
            <p class="section-subtitle" style="font-family: 'Poppins', sans-serif !important;">Testimoni dari pelanggan setia kami</p>
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="testimonial-item text-center">
                                    <div class="testimonial-img mb-4">
                                        <img src="{{ asset('storage/testimonials/user1.jpg') }}" alt="User" class="rounded-circle">
                                    </div>
                                    <p class="testimonial-text" style="font-family: 'Poppins', sans-serif !important;">"高品質な製品を手頃な価格で。迅速な配送と非常に満足のいくサービス！"</p>
                                    <h5 class="testimonial-name" style="font-family: 'Poppins', sans-serif !important;">Emperor Hirohito</h5>
                                    <p class="testimonial-position" style="font-family: 'Poppins', sans-serif !important;">Tokyo</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="testimonial-item text-center">
                                    <div class="testimonial-img mb-4">
                                        <img src="{{ asset('storage/testimonials/user2.jpg') }}" alt="User" class="rounded-circle">
                                    </div>
                                    <p class="testimonial-text" style="font-family: 'Poppins', sans-serif !important;">"Möbeldesign, das sehr gut zu dem Königreich passt, das ich gegründet habe. ICH GEBE IHNEN EINEN EHRENTITEL! ARBEIT MACHT FREI!"</p>
                                    <h5 class="testimonial-name" style="font-family: 'Poppins', sans-serif !important;">Adolf Hitler</h5>
                                    <p class="testimonial-position" style="font-family: 'Poppins', sans-serif !important;">Berlin</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="testimonial-item text-center">
                                    <div class="testimonial-img mb-4">
                                        <img src="{{ asset('storage/testimonials/user3.jpg') }}" alt="User" class="rounded-circle">
                                    </div>
                                    <p class="testimonial-text" style="font-family: 'Poppins', sans-serif !important;">" Я не ожидала, что найдется кто-то вроде вас, кто делает действительно хорошую мебель своими руками, она действительно подходит и соответствует моему вкусу."</p>
                                    <h5 class="testimonial-name" style="font-family: 'Poppins', sans-serif !important;">Joseph Stalin</h5>
                                    <p class="testimonial-position" style="font-family: 'Poppins', sans-serif !important;">Moscow</p>
                                </div>
                            </div>
                        </div>
                       
                       
                        
                        <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection