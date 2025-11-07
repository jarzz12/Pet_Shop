<?php

namespace App\Http\Controllers;

use App\Models\Category; // Pastikan model Category di-import
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the categories.
     */
    public function index()
    {
        // Ambil semua kategori
        $categories = Category::all();

        // Kirim data ke view
        return view('categories.index', compact('categories'));
    }

    /**
     * Display the specified category and its products.
     */
    public function show($id)
    {
        // Temukan kategori berdasarkan ID
        $category = Category::findOrFail($id);

        // Ambil produk-produk yang termasuk dalam kategori ini
        $products = $category->products()->paginate(12); // Gunakan pagination (opsional)

        // Kirim data ke view
        return view('categories.show', compact('category', 'products'));
    }

    // ... method lainnya (jika ada)
}