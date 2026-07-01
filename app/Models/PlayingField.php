<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['sport_center_id', 'name', 'type', 'price_hour', 'covered'])]
class PlayingField extends Model
{
    use HasFactory;

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function sport_center()
    {
        return $this->belongsTo(SportCenter::class);
    }
}
