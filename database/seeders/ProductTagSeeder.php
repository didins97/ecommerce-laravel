<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products_tags')->insert([
            ['product_id' => 1, 'tag_id' => 1,],
            ['product_id' => 1, 'tag_id' => 2,],
            ['product_id' => 1, 'tag_id' => 3,],
            ['product_id' => 2, 'tag_id' => 1,],
            ['product_id' => 2, 'tag_id' => 2,],
            ['product_id' => 2, 'tag_id' => 3,],
            ['product_id' => 3, 'tag_id' => 1,],
            ['product_id' => 3, 'tag_id' => 2,],
            ['product_id' => 3, 'tag_id' => 3,],
        ]);
    }
}
