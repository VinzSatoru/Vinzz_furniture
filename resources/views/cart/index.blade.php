@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Keranjang Belanja</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if(count($cartItems) > 0)
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    @foreach($cartItems as $item)
                    <div class="row mb-4">
                        <div class="col-md-2">
                            <img src="{{ asset('storage/' . $item['image']) }}" class="img-fluid rounded" alt="{{ $item['name'] }}">
                        </div>
                        <div class="col-md-6">
                            <h5 class="mb-1">{{ $item['name'] }}</h5>
                            <p class="text-muted mb-0">Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                        </div>
                        <div class="col-md-2">
                            <form action="{{ route('cart.update', $item['id']) }}" method="POST" class="d-flex align-items-center">
                                @csrf
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control form-control-sm" onchange="this.form.submit()">
                            </form>
                        </div>
                        <div class="col-md-2 text-end">
                            <p class="mb-0 fw-bold">Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</p>
                            <form action="{{ route('cart.remove', $item['id']) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link text-danger p-0">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    @if(!$loop->last)
                    <hr>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-4">Ringkasan Belanja</h5>
                    <div class="d-flex justify-content-between mb-3">
                        <span>Total Harga</span>
                        <span class="fw-bold">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <a href="{{ route('checkout.index') }}" class="btn btn-dark w-100">
                        Lanjut ke Pembayaran
                    </a>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="text-center py-5">
        <i class="fas fa-shopping-cart fa-3x mb-3 text-muted"></i>
        <h4 class="text-muted">Keranjang belanja Anda kosong</h4>
        <p class="text-muted">Silakan tambahkan produk ke keranjang Anda</p>
        <a href="{{ route('products.index') }}" class="btn btn-dark">
            Lihat Produk
        </a>
    </div>
    @endif
</div>
@endsection 