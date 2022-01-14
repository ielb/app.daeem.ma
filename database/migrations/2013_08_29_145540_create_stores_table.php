<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_type_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->string('logo');
            $table->string('cover');
            $table->string('phone')->nullable();
            $table->string('phone_two')->nullable();
            $table->string('address')->nullable();
            $table->foreignId('city_id')->constrained()->onDelete('cascade');
            $table->string('description')->nullable();
            $table->integer('commission')->nullable();
            $table->longtext('radius')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->integer('use_fake_rating');
            $table->integer('status');
            $table->text('recovery_token')->nullable();
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
        Schema::dropIfExists('stores');
    }
}
