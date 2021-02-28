<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventRoom extends Model
{
    use HasFactory;

    public function guests()
    {
        return $this->belongsToMany(Guest::class, 'guests_event_rooms', 'event_room', 'guest');
    }
}
