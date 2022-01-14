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
            $table->foreignId('store_id')->constrained()->onDelete('cascade');
            $table->string('sku');
            $table->string('name');
            $table->longText('description');
            $table->string('image')->nullable();
            $table->float('price');
            $table->float('weight')->nullable();
            $table->foreignId('subcategory_id')->constrained()->onDelete('cascade');
            $table->integer('available');
            $table->integer('status');
            $table->integer('has_variants');
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
