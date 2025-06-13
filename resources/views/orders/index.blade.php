@extends('layouts.app')

@section('title', 'Pesanan Saya')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Pesanan Saya</h2>

    @if($orders->isEmpty())
        <div class="alert alert-info">
            Anda belum memiliki pesanan.
        </div>
    @else
        <div class="row">
            @foreach($orders as $order)
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Pesanan #{{ $order->id }}</h5>
                            <span class="badge bg-{{ $order->status === 'pending' ? 'warning' : ($order->status === 'processing' ? 'info' : ($order->status === 'shipped' ? 'primary' : ($order->status === 'delivered' ? 'success' : 'danger'))) }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <p class="mb-1"><strong>Tanggal:</strong> {{ $order->created_at->format('d M Y H:i') }}</p>
                                @php
                                    $total = 0;
                                    foreach($order->orderDetails as $detail) {
                                        $total += $detail->price * $detail->quantity;
                                    }
                                @endphp
                                <p class="mb-1"><strong>Total:</strong> Rp {{ number_format($total, 0, ',', '.') }}</p>
                                <p class="mb-1"><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
                            </div>

                            <div class="mb-3">
                                <h6>Item Pesanan:</h6>
                                <ul class="list-unstyled">
                                    @foreach($order->orderDetails as $detail)
                                        <li class="mb-2">
                                            <div class="d-flex justify-content-between">
                                                <span>{{ $detail->product ? $detail->product->name : 'Produk tidak tersedia' }} ({{ $detail->quantity }}x)</span>
                                                <span>Rp {{ number_format($detail->price * $detail->quantity, 0, ',', '.') }}</span>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <a href="{{ route('orders.show', $order) }}" class="btn btn-primary w-100">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $orders->links() }}
        </div>
    @endif
</div>
@endsection 