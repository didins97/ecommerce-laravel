<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 10; $i++) {
            Product::create([
                'product_name' => 'kaos ' . $i,
                'slug' => 'kaos-'.$i,
                'price' => $i * 1000,
                'description' => 'lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quidem.',
                'stock' => 10,
                'weight' => 10,
                'featured' => 0,
                'image' => 'products/kaos'.rand(1,3).'.jpg',
                'images' => '["products/kaos1.jpg","products/kaos2.jpg","products/kaos3.jpg"]',
                'cat_id' => rand(1, 3),
                'child_cat_id' => rand(4, 10),
                'color_id' => rand(1, 8),
                'size_id' => rand(1, 5),
                'status' => 'active',
            ]);
        }

        for($i = 0; $i < 10; $i++) {
            Product::create([
                'product_name' => 'sepatu ' . $i,
                'slug' => 'sepatu-'.$i,
                'price' => $i * 1000,
                'description' => 'lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quidem.',
                'stock' => 10,
                'weight' => 10,
                'featured' => 0,
                'image' => 'products/sepatu'.rand(1,2).'.jpg',
                'images' => '["products/sepatu1.jpg","products/sepatu2.jpg"]',
                'cat_id' => rand(1, 3),
                'child_cat_id' => rand(4, 10),
                'color_id' => rand(1, 8),
                'size_id' => rand(1, 5),
                'status' => 'active',
            ]);
        }

        for($i = 0; $i < 10; $i++) {
            Product::create([
                'product_name' => 'laptop ' . $i,
                'slug' => 'laptop-'.$i,
                'price' => $i * 1000,
                'description' => 'lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quidem.',
                'stock' => 10,
                'weight' => 10,
                'featured' => 0,
                'image' => 'products/laptop'.rand(1,3).'.png',
                'images' => '["products/laptop1.png","products/laptop2.png","products/laptop3.png"]',
                'cat_id' => rand(1, 3),
                'child_cat_id' => rand(4, 10),
                'color_id' => rand(1, 8),
                'status' => 'active',
            ]);
        }
    }
}
