@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="container py-5">
    <div class="row">
        <!-- Product Images -->
        <div class="col-lg-6 mb-4">
            <div class="card border-0">
                <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded" alt="{{ $product->name }}">
                @if($product->images)
                <div class="row mt-3 g-2">
                    @foreach(json_decode($product->images) as $image)
                    <div class="col-3">
                        <img src="{{ asset('storage/' . $image) }}" class="img-fluid rounded" alt="{{ $product->name }}">
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>

        <!-- Product Info -->
        <div class="col-lg-6">
            <h1 class="mb-3">{{ $product->name }}</h1>
            <div class="price mb-4">Rp {{ number_format($product->price, 0, ',', '.') }}</div>

            <div class="mb-4">
                <h5 class="mb-3">Deskripsi Produk</h5>
                <p class="text-muted">{{ $product->description }}</p>
            </div>

            <div class="mb-4">
                <h5 class="mb-3">Spesifikasi</h5>
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Kategori</th>
                            <td>{{ $product->category->name }}</td>
                        </tr>
                        <tr>
                            <th>Material</th>
                            <td>{{ $product->material }}</td>
                        </tr>
                        <tr>
                            <th>Ukuran</th>
                            <td>{{ $product->dimensions }}</td>
                        </tr>
                        <tr>
                            <th>Warna</th>
                            <td>{{ $product->color }}</td>
                        </tr>
                        <tr>
                            <th>Stok</th>
                            <td>{{ $product->stock }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            @auth
                @if(auth()->user()->role === 'customer')
                <form action="{{ route('cart.store', $product) }}" method="POST" class="mb-4">
                    @csrf
                    <div class="row align-items-end">
                        <div class="col-md-4">
                            <label for="quantity" class="form-label">Jumlah</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" value="1" min="1" max="{{ $product->stock }}">
                        </div>
                        <div class="col-md-8">
                            <button type="submit" class="btn btn-dark w-100">
                                <i class="fas fa-shopping-cart me-2"></i>Tambah ke Keranjang
                            </button>
                        </div>
                    </div>
                </form>
                @endif
            @else
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i>
                Silakan <a href="{{ route('login') }}" class="alert-link">login</a> untuk membeli produk ini.
            </div>
            @endauth

            <!-- Product Features -->
            <div class="row g-4 mt-4">
                <div class="col-6">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-truck fa-2x me-3" style="color: var(--secondary-color);"></i>
                        <div>
                            <h6 class="mb-1">Pengiriman Cepat</h6>
                            <small class="text-muted">2-3 hari kerja</small>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-shield-alt fa-2x me-3" style="color: var(--secondary-color);"></i>
                        <div>
                            <h6 class="mb-1">Garansi Produk</h6>
                            <small class="text-muted">1 tahun garansi</small>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-undo fa-2x me-3" style="color: var(--secondary-color);"></i>
                        <div>
                            <h6 class="mb-1">Pengembalian</h6>
                            <small class="text-muted">14 hari pengembalian</small>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-headset fa-2x me-3" style="color: var(--secondary-color);"></i>
                        <div>
                            <h6 class="mb-1">Dukungan 24/7</h6>
                            <small class="text-muted">Layanan pelanggan</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.product-card {
    transition: transform 0.2s;
    border: none;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

.product-card .card-img-top {
    height: 200px;
    object-fit: cover;
}

.price {
    font-size: 1.2rem;
    font-weight: bold;
    color: #333;
}

.card-title {
    font-size: 1.1rem;
    margin-bottom: 0.5rem;
}

.card-text {
    font-size: 0.9rem;
    margin-bottom: 1rem;
}
</style>
@endsection 