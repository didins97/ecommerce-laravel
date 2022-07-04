<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('colors')->insert([
            ['name' => 'Black', 'code' => '#000000'],
            ['name' => 'White', 'code' => '#FFFFFF'],
            ['name' => 'Red', 'code' => '#FF0000'],
            ['name' => 'Green', 'code' => '#00FF00'],
            ['name' => 'Blue', 'code' => '#0000FF'],
            ['name' => 'Yellow', 'code' => '#FFFF00'],
            ['name' => 'Pink', 'code' => '#FF00FF'],
            ['name' => 'Orange', 'code' => '#FFA500'],
            ['name' => 'Purple', 'code' => '#800080'],
            ['name' => 'Brown', 'code' => '#A52A2A'],
            ['name' => 'Gray', 'code' => '#808080'],
            ['name' => 'Cyan', 'code' => '#00FFFF'],
            ['name' => 'Magenta', 'code' => '#FF00FF'],
            ['name' => 'Teal', 'code' => '#008080'],
            ['name' => 'Cream', 'code' => '#F0F0F0'],
            ['name' => 'Beige', 'code' => '#F5F5DC'],
            ['name' => 'Mauve', 'code' => '#E0B0FF'],
            ['name' => 'Lavender', 'code' => '#FFF0F5'],
            ['name' => 'Lime', 'code' => '#00FF00'],
            ['name' => 'Aqua', 'code' => '#00FFFF'],
            ['name' => 'Cyan', 'code' => '#00FFFF'],
            ['name' => 'Magenta', 'code' => '#FF00FF'],
            ['name' => 'Teal', 'code' => '#008080'],
            ['name' => 'Cream', 'code' => '#F0F0F0'],
        ]);
    }
}
