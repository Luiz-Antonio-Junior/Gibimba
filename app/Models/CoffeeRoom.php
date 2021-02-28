<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoffeeRoom extends Model
{
    use HasFactory;
    public function guests()
    {
        return $this->belongsToMany(Guest::class, 'guests_coffee_rooms', 'coffee_room', 'guest');
    }
}
