<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reviews')->insert([
            ['user_id' => 2, 'product_id' => 1, 'rating' => 5, 'comment' => 'Great product!', 'is_parent' => 1, 'parent_id' => null, 'status' => 'active'],
            ['user_id' => 2, 'product_id' => 2, 'rating' => 5, 'comment' => 'Great product!', 'is_parent' => 1, 'parent_id' => null, 'status' => 'active'],
            ['user_id' => 1, 'product_id' => 2, 'rating' => null, 'comment' => 'Oke', 'is_parent' => 0, 'parent_id' => 2, 'status' => 'active'],
        ]);
    }
}
