<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
     public function index()
    {
        // Ambil item-item di keranjang user yang sedang login
        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
        
        // Hitung total harga
        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);
        
        // Kirim data ke view
        return view('cart.index', compact('cartItems', 'total'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = Cart::firstOrCreate(
            [
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
            ],
            ['quantity' => 0]
        );

        $cart->quantity += $request->quantity;
        $cart->save();

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function update(Request $request, $id)
    {
        $cart = Cart::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $cart->update(['quantity' => $request->quantity]);
        return redirect()->back()->with('success', 'Cart updated!');
    }

    public function destroy($id)
    {
        $cart = Cart::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $cart->delete();
        return redirect()->back()->with('success', 'Product removed from cart!');
    }
}