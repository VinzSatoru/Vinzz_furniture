<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('customer');
    }

    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with(['orderDetails.product'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        // Pastikan user yang login adalah pemilik order
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $order->load(['orderDetails.product']);
        return view('orders.show', compact('order'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string',
            'shipping_phone' => 'required|string',
            'shipping_name' => 'required|string',
        ]);

        try {
            DB::beginTransaction();

            // Generate nomor pesanan
            $orderNumber = 'ORD-' . strtoupper(Str::random(8));

            // Buat pesanan
            $order = Order::create([
                'user_id' => auth()->id(),
                'order_number' => $orderNumber,
                'shipping_address' => $request->shipping_address,
                'shipping_phone' => $request->shipping_phone,
                'shipping_name' => $request->shipping_name,
                'status' => 'pending',
                'payment_status' => 'pending',
                'total_amount' => 0, // Akan diperbarui setelah menambahkan detail pesanan
            ]);

            // Dapatkan item keranjang
            $cart = session()->get('cart', []);
            $totalAmount = 0;

            // Buat detail pesanan
            foreach ($cart as $item) {
                $orderDetail = OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'subtotal' => $item['price'] * $item['quantity'],
                ]);

                $totalAmount += $orderDetail->subtotal;

                // Perbarui stok produk
                $product = $orderDetail->product;
                $product->decrement('stock', $item['quantity']);
            }

            // Perbarui total pesanan
            $order->update(['total_amount' => $totalAmount]);

            // Hapus keranjang
            session()->forget('cart');

            DB::commit();

            return redirect()->route('orders.show', $order)
                ->with('success', 'Pesanan berhasil dibuat!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function updateStatus(Request $request, Order $order)
    {
        $this->authorize('update', $order);

        $validated = $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled',
            'payment_status' => 'required|in:pending,paid,failed',
        ]);

        $order->update($validated);

        return redirect()->route('admin.orders.show', $order)
            ->with('success', 'Status pesanan berhasil diperbarui');
    }
} 