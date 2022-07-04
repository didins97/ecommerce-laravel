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
            ['user_id' => 2, 'product_id' => 1, 'rating' => 5, 'comment' => 'Great product!'],
            ['user_id' => 2, 'product_id' => 2, 'rating' => 4, 'comment' => 'Good product!'],
            ['user_id' => 2, 'product_id' => 3, 'rating' => 3, 'comment' => 'Not bad product!'],
            ['user_id' => 2, 'product_id' => 4, 'rating' => 2, 'comment' => 'Bad product!'],
            ['user_id' => 2, 'product_id' => 5, 'rating' => 1, 'comment' => 'Very bad product!'],
            ['user_id' => 2, 'product_id' => 6, 'rating' => 5, 'comment' => 'Great product!'],
            ['user_id' => 2, 'product_id' => 7, 'rating' => 4, 'comment' => 'Good product!'],
            ['user_id' => 2, 'product_id' => 8, 'rating' => 3, 'comment' => 'Not bad product!'],
            ['user_id' => 2, 'product_id' => 9, 'rating' => 2, 'comment' => 'Bad product!'],
        ]);
    }
}
