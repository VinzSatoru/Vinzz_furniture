@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="container py-5">
    <div class="row">
        <!-- Total Statistics -->
        <div class="col-md-3 mb-4">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Pendapatan</h5>
                    <h3 class="mb-0">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Pesanan</h5>
                    <h3 class="mb-0">{{ $totalOrders }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Produk</h5>
                    <h3 class="mb-0">{{ $totalProducts }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Customer</h5>
                    <h3 class="mb-0">{{ $totalCustomers }}</h3>
                </div>
            </div>
        </div>

        <!-- Monthly Statistics -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Pendapatan Bulan Ini</h5>
                </div>
                <div class="card-body">
                    <h3 class="mb-0">Rp {{ number_format($monthlyRevenue, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Pesanan Bulan Ini</h5>
                </div>
                <div class="card-body">
                    <h3 class="mb-0">{{ $monthlyOrders }}</h3>
                </div>
            </div>
        </div>

        <!-- Recent Orders -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Pesanan Terbaru</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Customer</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentOrders as $order)
                                <tr>
                                    <td>#{{ $order->id }}</td>
                                    <td>{{ $order->user->name }}</td>
                                    <td>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="badge bg-{{ $order->status === 'pending' ? 'warning' : ($order->status === 'processing' ? 'info' : ($order->status === 'shipped' ? 'primary' : ($order->status === 'delivered' ? 'success' : 'danger'))) }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top Selling Products -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Produk Terlaris</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Terjual</th>
                                    <th>Stok</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($topProducts as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->total_sold ?? 0 }}</td>
                                    <td>{{ $product->stock }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 