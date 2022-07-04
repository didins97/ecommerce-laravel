<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 3; $i++) {
            DB::table('banners')->insert([
                'title' => 'Banner '.$i,
                'description' => 'Banner '.$i.' Description',
                'image' => 'banner-'.$i.'.jpg',
            ]);
        }
    }
}
