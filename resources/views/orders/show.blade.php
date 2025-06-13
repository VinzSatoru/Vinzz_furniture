@extends('layouts.app')

@section('title', 'Detail Pesanan')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Detail Pesanan #{{ $order->id }}</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Status:</strong></p>
                            <span class="badge bg-{{ $order->status === 'pending' ? 'warning' : ($order->status === 'processing' ? 'info' : ($order->status === 'shipped' ? 'primary' : ($order->status === 'delivered' ? 'success' : 'danger'))) }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Tanggal Pesanan:</strong></p>
                            <p class="mb-0">{{ $order->created_at->format('d M Y H:i') }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Nama Penerima:</strong></p>
                            <p class="mb-0">{{ $order->shipping_name }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-1"><strong>No. Telepon:</strong></p>
                            <p class="mb-0">{{ $order->shipping_phone }}</p>
                        </div>
                    </div>

                    <div class="mb-3">
                        <p class="mb-1"><strong>Alamat Pengiriman:</strong></p>
                        <p class="mb-0">{{ $order->shipping_address }}</p>
                    </div>

                    <h6 class="mb-3">Item Pesanan:</h6>
                    @if($order->orderDetails && count($order->orderDetails) > 0)
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
                                    @php
                                        $total = 0;
                                    @endphp
                                    @foreach($order->orderDetails as $detail)
                                        @php
                                            $subtotal = $detail->price * $detail->quantity;
                                            $total += $subtotal;
                                        @endphp
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if($detail->product && $detail->product->image)
                                                        <img src="{{ asset('storage/' . $detail->product->image) }}" 
                                                             alt="{{ $detail->product->name }}" 
                                                             class="img-thumbnail me-3" 
                                                             style="width: 50px; height: 50px; object-fit: cover;">
                                                    @endif
                                                    <div>
                                                        <h6 class="mb-0">{{ $detail->product ? $detail->product->name : 'Produk tidak tersedia' }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>Rp {{ number_format($detail->price, 0, ',', '.') }}</td>
                                            <td>{{ $detail->quantity }}</td>
                                            <td>Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="text-end"><strong>Total:</strong></td>
                                        <td><strong>Rp {{ number_format($total, 0, ',', '.') }}</strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info">
                            Tidak ada item dalam pesanan ini.
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Status Pengiriman</h5>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        @php
                            $statuses = [
                                'pending' => ['icon' => 'clock', 'text' => 'Menunggu Konfirmasi'],
                                'processing' => ['icon' => 'cog', 'text' => 'Sedang Diproses'],
                                'shipped' => ['icon' => 'truck', 'text' => 'Dalam Pengiriman'],
                                'delivered' => ['icon' => 'check-circle', 'text' => 'Terkirim'],
                                'cancelled' => ['icon' => 'times-circle', 'text' => 'Dibatalkan']
                            ];
                            $currentStatus = array_search($order->status, array_keys($statuses));
                        @endphp

                        @foreach($statuses as $key => $status)
                            <div class="timeline-item {{ $key === $order->status ? 'active' : ($currentStatus > array_search($key, array_keys($statuses)) ? 'completed' : '') }}">
                                <div class="timeline-icon">
                                    <i class="fas fa-{{ $status['icon'] }}"></i>
                                </div>
                                <div class="timeline-content">
                                    <h6 class="mb-0">{{ $status['text'] }}</h6>
                                    @if($key === $order->status)
                                        <small class="text-muted">Status saat ini</small>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.timeline {
    position: relative;
    padding: 20px 0;
}

.timeline-item {
    position: relative;
    padding-left: 40px;
    margin-bottom: 20px;
}

.timeline-item:last-child {
    margin-bottom: 0;
}

.timeline-item::before {
    content: '';
    position: absolute;
    left: 15px;
    top: 0;
    bottom: -20px;
    width: 2px;
    background-color: #e0e0e0;
}

.timeline-item:last-child::before {
    display: none;
}

.timeline-icon {
    position: absolute;
    left: 0;
    top: 0;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background-color: #e0e0e0;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #757575;
}

.timeline-item.active .timeline-icon {
    background-color: var(--secondary-color);
    color: var(--primary-color);
}

.timeline-item.completed .timeline-icon {
    background-color: var(--success-color);
    color: white;
}

.timeline-item.completed::before {
    background-color: var(--success-color);
}

.timeline-content {
    padding: 10px;
    background-color: #f8f9fa;
    border-radius: 4px;
}

.timeline-item.active .timeline-content {
    background-color: var(--secondary-color);
    color: var(--primary-color);
}

.timeline-item.completed .timeline-content {
    background-color: #e8f5e9;
}
</style>
@endsection 