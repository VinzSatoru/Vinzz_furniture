@extends('layouts.admin')

@section('title', 'Detail Pesanan')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Detail Pesanan #{{ $order->id }}</h2>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-md-8">
            <!-- Order Details -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Detail Pesanan</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->orderDetails as $detail)
                                    <tr>
                                        <td>{{ $detail->product->name }}</td>
                                        <td>Rp {{ number_format($detail->price, 0, ',', '.') }}</td>
                                        <td>{{ $detail->quantity }}</td>
                                        <td>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3" class="text-end">Total:</th>
                                    @php
                                    $total = 0;
                                    foreach($order->orderDetails as $detail) {
                                        $total += $detail->price * $detail->quantity;
                                    }
                                     @endphp
                                    <th>Rp {{ number_format($total, 0, ',', '.') }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Customer Information -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Informasi Customer</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Nama:</strong> {{ $order->user->name }}</p>
                            <p><strong>Email:</strong> {{ $order->user->email }}</p>
                            <p><strong>Telepon:</strong> {{ $order->user->phone }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Alamat:</strong></p>
                            <p>{{ $order->shipping_address }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <!-- Order Status -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Status Pesanan</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.orders.update-status', $order) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="mb-3">
                            <label for="status" class="form-label">Status Pesanan</label>
                            <select name="status" id="status" class="form-select">
                                <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                                <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                                <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="payment_status" class="form-label">Status Pembayaran</label>
                            <select name="payment_status" id="payment_status" class="form-select">
                                <option value="pending" {{ $order->payment_status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="paid" {{ $order->payment_status === 'paid' ? 'selected' : '' }}>Paid</option>
                                <option value="failed" {{ $order->payment_status === 'failed' ? 'selected' : '' }}>Failed</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Status</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 