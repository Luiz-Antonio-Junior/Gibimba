<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestsEventRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guests_event_rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guest')->references('id')->on('guests');
            $table->foreignId('event_room')->references('id')->on('event_rooms');
            $table->string('stage');
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
        Schema::dropIfExists('guests_event_rooms');
    }
}
