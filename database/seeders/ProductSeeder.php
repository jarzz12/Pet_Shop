<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $categories = Category::all();
        
        $products = [
            [
                'category_id' => $categories->first()->id,
                'name' => 'Premium Dog Food',
                'description' => 'High-quality nutrition for your dog',
                'price' => 150000,
                'stock' => 50,
                'image' => 'https://down-ph.img.susercontent.com/file/ph-11134207-7r98p-lz6xl61u89hab5'
            ],
            [
                'category_id' => $categories->first()->id,
                'name' => 'Cat Treats',
                'description' => 'Delicious treats for cats',
                'price' => 50000,
                'stock' => 100,
                'image' => 'https://tse4.mm.bing.net/th/id/OIP.eWZlE2s7OCHpUsO8aCcYHgHaHa?pid=Api&P=0&h=220'
            ],
            [
                'category_id' => $categories[1]->id,
                'name' => 'Interactive Cat Toy',
                'description' => 'Fun toy to keep your cat active',
                'price' => 75000,
                'stock' => 30,
                'image' => 'https://tse2.mm.bing.net/th/id/OIP.bZrPXXO0SQOskwBER-VE5gHaH8?pid=Api&P=0&h=220'
            ],
            [
                'category_id' => $categories[2]->id,
                'name' => 'Pet Shampoo',
                'description' => 'Gentle shampoo for pets',
                'price' => 45000,
                'stock' => 75,
                'image' => 'https://m.media-amazon.com/images/I/81ltNED+j7L._AC_.jpg'
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}