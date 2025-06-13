<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Auth::check() || Auth::user()->role !== 'admin') {
                return redirect()->route('home')->with('error', 'Akses ditolak. Anda tidak memiliki izin untuk mengakses halaman ini.');
            }
            return $next($request);
        });
    }

    public function index()
    {
        // Total Statistics
        $totalRevenue = Order::where('status', '!=', 'cancelled')
            ->where('payment_status', 'paid')
            ->sum('total_amount');
        $totalOrders = Order::count();
        $totalProducts = Product::count();
        $totalCustomers = User::where('role', 'customer')->count();

        // Monthly Statistics
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $monthlyRevenue = Order::where('status', '!=', 'cancelled')
            ->where('payment_status', 'paid')
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->sum('total_amount');

        $monthlyOrders = Order::whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->count();

        // Recent Orders
        $recentOrders = Order::with(['user', 'orderDetails.product'])
            ->latest()
            ->take(5)
            ->get();

        // Top Selling Products
        $topProducts = Product::withCount(['orderDetails as total_sold' => function($query) {
                $query->select(DB::raw('SUM(quantity)'))
                    ->join('orders', 'orders.id', '=', 'order_details.order_id')
                    ->where('orders.status', '!=', 'cancelled')
                    ->where('orders.payment_status', 'paid');
            }])
            ->orderBy('total_sold', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalRevenue',
            'totalOrders',
            'totalProducts',
            'totalCustomers',
            'monthlyRevenue',
            'monthlyOrders',
            'recentOrders',
            'topProducts'
        ));
    }
} 