<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category; // Pastikan model Category di-import
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // Ambil filter kategori jika ada
        $categoryId = request('category');

        // Query produk, filter berdasarkan kategori jika diperlukan
        $query = Product::with('category'); // Eager load category

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        // Ambil produk dengan pagination
        $products = $query->paginate(12); // 12 produk per halaman

        // Ambil semua kategori untuk filter
        $categories = Category::all();

        // Kirim data ke view
        return view('products.index', compact('products', 'categories'));
    }

    // ... method lainnya
}
