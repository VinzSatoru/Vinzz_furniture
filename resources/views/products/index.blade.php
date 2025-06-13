@extends('layouts.app')

@section('title', 'Katalog Produk')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
@endpush

@section('content')
<div class="container py-5">
    <!-- Page Title -->
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold" style="font-family: 'Poppins', sans-serif !important;">Katalog Produk</h1>
        <p class="lead text-muted" style="font-family: 'Poppins', sans-serif !important;">Temukan furniture berkualitas untuk hunian Anda</p>
    </div>

    <!-- Search and Filter Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('products.index') }}" method="GET" class="row g-3">
                        <!-- Search Bar -->
                        <div class="col-md-6">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Cari produk..." value="{{ request('search') }}">
                                <button class="btn btn-dark" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Category Filter -->
                        <div class="col-md-3">
                            <select name="category" class="form-select" onchange="this.form.submit()">
                                <option value="">Semua Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Sort Options -->
                        <div class="col-md-3">
                            <select name="sort" class="form-select" onchange="this.form.submit()">
                                <option value="">Urutkan</option>
                                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Harga: Rendah ke Tinggi</option>
                                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Harga: Tinggi ke Rendah</option>
                                <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nama: A-Z</option>
                                <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Nama: Z-A</option>
                            </select>
                        </div>

                        <!-- Price Range Filter -->
                        <div class="col-md-6">
                            <div class="row g-2">
                                <div class="col">
                                    <input type="number" name="min_price" class="form-control" placeholder="Harga Min" value="{{ request('min_price') }}">
                                </div>
                                <div class="col">
                                    <input type="number" name="max_price" class="form-control" placeholder="Harga Max" value="{{ request('max_price') }}">
                                </div>
                            </div>
                        </div>

                        <!-- Filter Button -->
                        <div class="col-md-6 text-end">
                            <button type="submit" class="btn btn-dark">
                                <i class="fas fa-filter"></i> Terapkan Filter
                            </button>
                            <a href="{{ route('products.index') }}" class="btn btn-outline-dark">
                                <i class="fas fa-times"></i> Reset
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="row g-4">
        @forelse($products as $product)
        <div class="col-md-4 col-lg-3">
            <div class="card h-100 product-card">
                <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text text-muted">{{ Str::limit($product->description, 100) }}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        <a href="{{ route('products.show', $product) }}" class="btn btn-dark">Detail</a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-info text-center">
                Tidak ada produk yang ditemukan.
            </div>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $products->links() }}
    </div>
</div>

<style>
.product-card {
    transition: transform 0.2s;
    border: none;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    font-family: 'Poppins', sans-serif !important;
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
    font-family: 'Poppins', sans-serif !important;
}

.card-title {
    font-size: 1.1rem;
    margin-bottom: 0.5rem;
    font-family: 'Poppins', sans-serif !important;
    font-weight: 600 !important;
}

.card-text {
    font-size: 0.9rem;
    margin-bottom: 1rem;
    font-family: 'Poppins', sans-serif !important;
}

/* Form elements styling */
.form-control,
.form-select,
.btn {
    font-family: 'Poppins', sans-serif !important;
}

/* Alert styling */
.alert {
    font-family: 'Poppins', sans-serif !important;
}
</style>
@endsection 