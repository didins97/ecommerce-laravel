<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->insert([
            ['name' => 'Tag 1', 'slug' => 'tag-1'],
            ['name' => 'Tag 2', 'slug' => 'tag-2'],
            ['name' => 'Tag 3', 'slug' => 'tag-3'],
        ]);
    }
}
