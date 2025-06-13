<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = User::where('role', 'customer')
            ->withCount('orders')
            ->latest()
            ->paginate(10);
        return view('admin.customers.index', compact('customers'));
    }

    public function show(User $customer)
    {
        $customer->load(['orders' => function($query) {
            $query->with('orderDetails.product')->latest();
        }]);
        return view('admin.customers.show', compact('customer'));
    }
} 