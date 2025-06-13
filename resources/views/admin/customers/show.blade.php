@extends('layouts.admin')

@section('title', 'Detail Customer')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Detail Customer</h2>
        <a href="{{ route('admin.customers.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-md-4">
            <!-- Customer Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Informasi Customer</h5>
                </div>
                <div class="card-body">
                    <p><strong>Nama:</strong> {{ $customer->name }}</p>
                    <p><strong>Email:</strong> {{ $customer->email }}</p>
                    <p><strong>Telepon:</strong> {{ $customer->phone ?? '-' }}</p>
                    <p><strong>Alamat:</strong> {{ $customer->address ?? '-' }}</p>
                    <p><strong>Tanggal Bergabung:</strong> {{ $customer->created_at->format('d M Y') }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <!-- Order History -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Riwayat Pesanan</h5>
                </div>
                <div class="card-body">
                    @if($customer->orders->isEmpty())
                        <p class="text-muted mb-0">Belum ada pesanan.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($customer->orders as $order)
                                        <tr>
                                            <td>#{{ $order->id }}</td>
                                            <td>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                            <td>
                                                <span class="badge bg-{{ $order->status === 'pending' ? 'warning' : ($order->status === 'processing' ? 'info' : ($order->status === 'shipped' ? 'primary' : ($order->status === 'delivered' ? 'success' : 'danger'))) }}">
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                            </td>
                                            <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                                            <td>
                                                <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-primary">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 