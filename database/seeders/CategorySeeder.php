<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['name' => 'category 1', 'slug' => 'category-1', 'is_parent' => 1, 'parent_id' => null],
            ['name' => 'category 2', 'slug' => 'category-2', 'is_parent' => 1, 'parent_id' => null],
            ['name' => 'category 3', 'slug' => 'category-3', 'is_parent' => 1, 'parent_id' => null],
            ['name' => 'category 4', 'slug' => 'category-4', 'is_parent' => null, 'parent_id' => 1],
            ['name' => 'category 5', 'slug' => 'category-5', 'is_parent' => null, 'parent_id' => 2],
            ['name' => 'category 6', 'slug' => 'category-6', 'is_parent' => null, 'parent_id' => 3],
            ['name' => 'category 7', 'slug' => 'category-7', 'is_parent' => null, 'parent_id' => 1],
            ['name' => 'category 8', 'slug' => 'category-8', 'is_parent' => null, 'parent_id' => 2],
            ['name' => 'category 9', 'slug' => 'category-9', 'is_parent' => null, 'parent_id' => 3],
            ['name' => 'category 10', 'slug' => 'category-10', 'is_parent' => null, 'parent_id' => 1],
            ['name' => 'category 11', 'slug' => 'category-11', 'is_parent' => null, 'parent_id' => 2],
            ['name' => 'category 12', 'slug' => 'category-12', 'is_parent' => null, 'parent_id' => 3],
        ]);
    }
}
