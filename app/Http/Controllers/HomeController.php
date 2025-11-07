<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::limit(4)->get();
        $products = Product::with('category')->latest()->limit(8)->get();
        
        return view('home', compact('categories', 'products'));
    }
}