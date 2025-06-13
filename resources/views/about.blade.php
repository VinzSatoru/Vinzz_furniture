@extends('layouts.app')

@section('title', 'Tentang Kami')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-6 mb-4">
            <h1 class="display-4 mb-4">Tentang Vinzz Furniture</h1>
            <p class="lead">Kami adalah penyedia furniture berkualitas dengan desain modern dan klasik untuk hunian nyaman Anda.</p>
            <p>Vinzz Furniture didirikan pada tahun 2024 dengan visi untuk memberikan solusi furniture terbaik bagi setiap rumah tangga Indonesia. Kami menggabungkan desain modern dengan kualitas terbaik untuk menciptakan furniture yang tidak hanya indah tetapi juga tahan lama.</p>
        </div>
        <div class="col-md-6">
            <img src="https://images.unsplash.com/photo-1555041469-a586c61ea9bc" alt="Furniture Showroom" class="img-fluid rounded shadow">
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-12">
            <h2 class="mb-4">Mengapa Memilih Kami?</h2>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-medal fa-3x mb-3 text-secondary"></i>
                    <h3 class="h5">Kualitas Terjamin</h3>
                    <p>Kami hanya menggunakan material berkualitas tinggi untuk setiap produk kami.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-truck fa-3x mb-3 text-secondary"></i>
                    <h3 class="h5">Pengiriman Cepat</h3>
                    <p>Layanan pengiriman cepat dan aman ke seluruh Indonesia.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-headset fa-3x mb-3 text-secondary"></i>
                    <h3 class="h5">Layanan 24/7</h3>
                    <p>Tim customer service kami siap membantu Anda 24/7.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-12">
            <h2 class="mb-4">Visi & Misi</h2>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h3 class="h5 mb-3">Visi</h3>
                    <p>Menjadi penyedia furniture terpercaya yang mengutamakan kualitas dan kepuasan pelanggan.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h3 class="h5 mb-3">Misi</h3>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-check text-success me-2"></i> Menyediakan produk berkualitas tinggi</li>
                        <li><i class="fas fa-check text-success me-2"></i> Memberikan pelayanan terbaik</li>
                        <li><i class="fas fa-check text-success me-2"></i> Mengutamakan kepuasan pelanggan</li>
                        <li><i class="fas fa-check text-success me-2"></i> Mengembangkan inovasi desain</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 