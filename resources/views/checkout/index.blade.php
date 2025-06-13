@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Informasi Pengiriman</h5>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h6>Data Pengiriman:</h6>
                        <p class="mb-1"><strong>Nama:</strong> {{ $user->name }}</p>
                        <p class="mb-1"><strong>No. Telepon:</strong> {{ $user->phone }}</p>
                        <p class="mb-1"><strong>Alamat:</strong> {{ $user->address }}</p>
                    </div>
                    <form action="{{ route('checkout.store') }}" method="POST">
                        @csrf
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            Data pengiriman akan menggunakan data dari profil Anda. 
                            Jika ingin mengubah data pengiriman, silakan update profil Anda terlebih dahulu.
                        </div>
                        <button type="submit" class="btn btn-primary">Buat Pesanan</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Ringkasan Pesanan</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total = 0;
                                @endphp
                                @foreach($cart as $item)
                                    @php
                                        $subtotal = $item['price'] * $item['quantity'];
                                        $total += $subtotal;
                                    @endphp
                                    <tr>
                                        <td>{{ $item['name'] }}</td>
                                        <td>{{ $item['quantity'] }}</td>
                                        <td>Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="2">Total</th>
                                    <th>Rp {{ number_format($total, 0, ',', '.') }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 