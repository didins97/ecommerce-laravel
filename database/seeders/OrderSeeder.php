<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 3; $i++) {
            DB::table('orders')->insert([
                'user_id' => $i,
                'invoice_number' => 'INV-'.date('YmdHis').'-'.$i,
                'name' => 'name '.$i,
                'email' => 'name'.$i.'@gmail.com',
                'address' => 'address '.$i,
                'province' => 'province '.$i,
                'city' => 'city '.$i,
                'postal_code' => 'postal_code '.$i,
                'phone' => '09'.$i.'1234567',
                'status' => 'pending',
                'payment_status' => 'menunggu_pembayaran',
                'payment_method' => 'online',
            ]);
        }
    }
}
