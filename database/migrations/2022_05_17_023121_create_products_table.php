<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name', 50);
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->integer('price');
            $table->string('weight')->nullable();
            $table->unsignedBigInteger('cat_id')->nullable();
            $table->unsignedBigInteger('child_cat_id')->nullable();
            $table->unsignedBigInteger('color_id')->nullable();
            $table->unsignedBigInteger('size_id')->nullable();
            $table->boolean('featured')->default(0);
            $table->integer('stock')->default(1);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->string('image')->nullable();
            $table->text('images')->nullable();
            $table->foreign('cat_id')->references('id')->on('categories')->onDelete('SET NULL');
            $table->foreign('child_cat_id')->references('id')->on('categories')->onDelete('SET NULL');
            
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
        Schema::dropIfExists('products');
    }
}
