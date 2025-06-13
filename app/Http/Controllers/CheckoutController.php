<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')
                ->with('error', 'Keranjang belanja kosong');
        }

        $user = auth()->user();
        return view('checkout.index', compact('cart', 'user'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        try {
            DB::beginTransaction();

            // Generate nomor pesanan
            $orderNumber = 'ORD-' . strtoupper(Str::random(8));

            // Buat pesanan
            $order = Order::create([
                'user_id' => $user->id,
                'order_number' => $orderNumber,
                'shipping_address' => $user->address,
                'shipping_phone' => $user->phone,
                'shipping_name' => $user->name,
                'status' => 'pending',
                'payment_status' => 'pending',
                'total_amount' => 0, // Akan diperbarui setelah menambahkan detail pesanan
            ]);

            // Dapatkan item keranjang
            $cart = session()->get('cart', []);
            $totalAmount = 0;

            // Buat detail pesanan
            foreach ($cart as $id => $item) {
                $orderDetail = OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $id,
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
} 