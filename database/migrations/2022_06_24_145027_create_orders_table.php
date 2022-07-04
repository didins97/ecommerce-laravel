<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('invoice_number', 50);
            $table->string('name', 50);
            $table->string('email', 50);
            $table->string('phone', 50);
            $table->text('address');
            $table->string('province', 50);
            $table->string('city', 50);
            $table->string('postal_code', 50);
            $table->enum('status', ['pending', 'on_process', 'shipping', 'delivered', 'canceled'])->default('pending');
            $table->enum('payment_status', ['menunggu_pembayaran', 'dibayar', 'kadaluarsa'])->default('menunggu_pembayaran');
            $table->enum('payment_method', ['online', 'cod'])->default('online');
            $table->timestamps();
        });

        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->integer('qty');
            $table->integer('subtotal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
        Schema::dropIfExists('order_details');
    }
}
