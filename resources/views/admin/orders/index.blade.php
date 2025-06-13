@extends('layouts.admin')

@section('title', 'Kelola Pesanan')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Kelola Pesanan</h2>

    <div class="card">
        <div class="card-body">
            @if($orders->isEmpty())
                <p class="text-muted mb-0">Belum ada pesanan.</p>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>#{{ $order->id }}</td>
                                    <td>{{ $order->user->name }}</td>
                                    @php
                                    $total = 0;
                                    foreach($order->orderDetails as $detail) {
                                        $total += $detail->price * $detail->quantity;
                                    }
                                    @endphp
                                    <td>Rp {{ number_format($total, 0, ',', '.') }}</td>
                                    <td>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h5 class="mb-0">Pesanan #{{ $order->id }}</h5>
                                            <div>
                                                <span class="badge bg-{{ $order->status === 'pending' ? 'warning' : ($order->status === 'processing' ? 'info' : ($order->status === 'shipped' ? 'primary' : ($order->status === 'delivered' ? 'success' : 'danger'))) }}">
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                                <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesanan ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm ms-2">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
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

                <div class="d-flex justify-content-center mt-4">
                    {{ $orders->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection 