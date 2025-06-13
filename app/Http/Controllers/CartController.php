<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart', []);
        $total = 0;
        $cartItems = [];
        
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
            $cartItems[] = [
                'id' => $item['id'],
                'name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
                'image' => $item['image'],
                'subtotal' => $item['price'] * $item['quantity']
            ];
        }
        
        return view('cart.index', compact('cartItems', 'total'));
    }

    public function store(Request $request, Product $product)
    {
        $quantity = $request->quantity ?? 1;

        $cart = Session::get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
                'image' => $product->image
            ];
        }

        Session::put('cart', $cart);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang');
    }

    public function add(Product $product)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->image
            ];
        }

        Session::put('cart', $cart);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang');
    }

    public function remove(Product $product)
    {
        $cart = Session::get('cart', []);
        
        if (isset($cart[$product->id])) {
            unset($cart[$product->id]);
            Session::put('cart', $cart);
        }
        
        return redirect()->back()->with('success', 'Produk berhasil dihapus dari keranjang');
    }

    public function update(Request $request, Product $product)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] = $request->quantity;
            Session::put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Jumlah produk berhasil diperbarui');
    }
} 