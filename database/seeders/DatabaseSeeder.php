<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategorySeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(TagSeeder::class);
        $this->call(ProductTagSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(OrderDetailSeeder::class);
        $this->call(BannerSeeder::class);
        $this->call(ReviewSeeder::class);
        $this->call(WishlistSeeder::class);
        $this->call(SizeSeeder::class);
        $this->call(ColorSeeder::class);
        
    }
}
