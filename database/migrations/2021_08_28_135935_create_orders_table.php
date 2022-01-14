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
            $table->string('code');
            $table->foreignId('address_id')->constrained()->onDelete('cascade');
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->foreignId('store_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->nullable();
            $table->foreignId('collector_id')->references('id')->on('users')->onDelete('cascade')->nullable();
            $table->foreignId('status_id')->constrained()->onDelete('cascade');
            $table->float('delivery_price');
            $table->float('order_price');
            $table->integer('use_coupon');
            $table->float('price_after_coupon')->nullable();
            $table->float('discount_price')->nullable();
            $table->string('payment_method');
            $table->integer('use_delivery_time');
            $table->dateTime('delivery_time')->nullable();
            $table->string('delivery_pickup_interval')->nullable();
            $table->integer('seen')->default('0');
            $table->integer('seen_by_driver')->default('0');
            $table->integer('seen_by_collector')->default('0');
            $table->longtext('invoice_images')->nullable();
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
    }
}
