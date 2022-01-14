<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hours', function (Blueprint $table) {
            $table->id();
            $table->string('0_from')->nullable();
            $table->string('0_to')->nullable();
            $table->string('1_from')->nullable();
            $table->string('1_to')->nullable();
            $table->string('2_from')->nullable();
            $table->string('2_to')->nullable();
            $table->string('3_from')->nullable();
            $table->string('3_to')->nullable();
            $table->string('4_from')->nullable();
            $table->string('4_to')->nullable();
            $table->string('5_from')->nullable();
            $table->string('5_to')->nullable();
            $table->string('6_from')->nullable();
            $table->string('6_to')->nullable();
            $table->string('day_off')->nullable();
            $table->foreignId('store_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('hours');
    }
}
