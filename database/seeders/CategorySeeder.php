<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'name' => 'Food & Nutrition',
                'description' => 'High-quality food for your pets',
                'image' => 'https://m.media-amazon.com/images/I/81xyE8OZBqL.jpg'
            ],
            [
                'name' => 'Toys & Accessories',
                'description' => 'Fun toys and accessories for your pets',
                'image' => 'https://down-id.img.susercontent.com/file/id-11134207-7r98o-lme2s68mx99b9b'
            ],
            [
                'name' => 'Health & Grooming',
                'description' => 'Health and grooming products',
                'image' => 'http://carevetdev.kinsta.cloud/wp-content/uploads/2024/10/dog-grooming-2.jpg'
            ],
            [
                'name' => 'Housing & Furniture',
                'description' => 'Comfortable housing and furniture',
                'image' => 'https://tse4.mm.bing.net/th/id/OIP.jHVmeQB7BXm09I3ng98dZAHaHa?pid=Api&P=0&h=220'
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}