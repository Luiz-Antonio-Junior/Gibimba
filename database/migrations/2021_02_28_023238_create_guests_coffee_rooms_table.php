<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestsCoffeeRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guests_coffee_rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guest')->references('id')->on('guests');
            $table->foreignId('coffee_room')->references('id')->on('coffee_rooms');
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
        Schema::dropIfExists('guests_coffee_rooms');
    }
}
