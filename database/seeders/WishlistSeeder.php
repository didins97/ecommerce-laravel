<?php

namespace Database\Seeders;

use App\Models\Wishlist;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WishlistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wishlists')->insert([
            ['user_id' => 2, 'product_id' => 1],
            ['user_id' => 2, 'product_id' => 2],
            ['user_id' => 2, 'product_id' => 3],
            ['user_id' => 2, 'product_id' => 4],
            ['user_id' => 2, 'product_id' => 5],
            ['user_id' => 2, 'product_id' => 6],
            ['user_id' => 2, 'product_id' => 7],
            ['user_id' => 2, 'product_id' => 8],
            ['user_id' => 2, 'product_id' => 9],
        ]);
    }
}
