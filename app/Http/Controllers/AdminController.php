<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalCategories = Category::count();
        $totalRevenue = Order::where('status', 'delivered')->sum('total_price');
        
        $recentOrders = Order::with('user')->latest()->limit(5)->get();
        
        return view('admin.dashboard', compact(
            'totalProducts', 
            'totalOrders', 
            'totalCategories', 
            'totalRevenue', 
            'recentOrders'
        ));
    }
}