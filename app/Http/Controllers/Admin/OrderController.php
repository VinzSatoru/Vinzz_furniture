<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'orderDetails.product'])
            ->latest()
            ->paginate(10);
            
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['user', 'orderDetails.product']);
        return view('admin.orders.show', compact('order'));
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

    public function destroy(Order $order)
    {
        try {
            DB::beginTransaction();
            
            // Kembalikan stok produk
            foreach ($order->orderDetails as $detail) {
                $product = $detail->product;
                if ($product) {
                    $product->increment('stock', $detail->quantity);
                }
            }

            // Hapus order details
            $order->orderDetails()->delete();
            
            // Hapus order
            $order->delete();

            DB::commit();

            return redirect()->route('admin.orders.index')
                ->with('success', 'Pesanan berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Gagal menghapus pesanan: ' . $e->getMessage());
        }
    }
} 