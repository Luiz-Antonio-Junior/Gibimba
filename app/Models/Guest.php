<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;

    public function eventRooms()
    {
        return $this->belongsToMany(EventRoom::class, 'guests_event_rooms', 'guest', 'event_room');
    }

    public function coffeeRooms()
    {
        return $this->belongsToMany(CoffeeRoom::class, 'guests_coffee_rooms', 'guest', 'coffee_room');
    }
}
