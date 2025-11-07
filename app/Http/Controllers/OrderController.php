<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the user's orders.
     */
    public function index()
    {
        // Ambil semua order milik user yang sedang login
        $orders = Order::where('user_id', Auth::id())
                       ->with('orderItems.product') // Eager load untuk menghindari N+1 query
                       ->latest() // Urutkan dari yang terbaru
                       ->paginate(10); // Gunakan pagination (opsional)

        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        // Ambil item-item di keranjang user yang sedang login
        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
        
        // Cek jika keranjang kosong
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        // Hitung total harga
        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);
        
        // Kirim data ke view checkout
        return view('orders.create', compact('cartItems', 'total'));
    }

    public function store(Request $request)
    {
        // Ambil item-item di keranjang user yang sedang login
        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
        
        // Cek jika keranjang kosong
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        // Hitung total harga
        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        // Buat order baru
        $order = Order::create([
            'user_id' => Auth::id(),
            'total_price' => $total,
            'status' => 'pending' // Atau status awal lainnya
        ]);

        // Buat item-item order dan kurangi stok
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price
            ]);
            
            // Kurangi stok produk
            $product = $item->product;
            $product->stock -= $item->quantity;
            $product->save();
        }

        // Hapus item dari keranjang setelah order dibuat
        Cart::where('user_id', Auth::id())->delete();

        // Redirect ke halaman order index dengan pesan sukses
        return redirect()->route('orders.index')->with('success', 'Order placed successfully!');
    }

    public function show($id)
    {
        // Temukan order berdasarkan ID dan pastikan milik user yang sedang login
        $order = Order::where('id', $id)
                      ->where('user_id', Auth::id())
                      ->with('orderItems.product') // Eager load untuk menampilkan produk di detail
                      ->firstOrFail(); // Jika tidak ditemukan, tampilkan 404

        return view('orders.show', compact('order'));
    }

    // ... method lainnya bisa ditambahkan di sini jika diperlukan
    // Misalnya: show($id) untuk melihat detail pesanan
}