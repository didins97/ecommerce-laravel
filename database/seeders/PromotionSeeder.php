<?php

namespace Database\Seeders;

use App\Models\Promotion;
use Illuminate\Database\Seeder;

class PromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Promotion::create([
            'title' => 'Promo 1',
            'description' => 'Description promo 1',
            'time_limit' => '2020-12-31 12:00:00',
            'image' => 'promo1.jpg',
            'is_active' => 1,
            'product_id' => 1,
        ]);
    }
}
