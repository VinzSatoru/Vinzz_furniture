@extends('layouts.admin')

@section('title', 'Kelola Customer')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Kelola Customer</h2>

    <div class="card">
        <div class="card-body">
            @if($customers->isEmpty())
                <p class="text-muted mb-0">Belum ada customer.</p>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Telepon</th>
                                <th>Total Pesanan</th>
                                <th>Tanggal Bergabung</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($customers as $customer)
                                <tr>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>{{ $customer->phone ?? '-' }}</td>
                                    <td>{{ $customer->orders_count }}</td>
                                    <td>{{ $customer->created_at->format('d M Y') }}</td>
                                    <td>
                                        <a href="{{ route('admin.customers.show', $customer) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-4">
                    {{ $customers->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection 