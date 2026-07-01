<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['user_id', 'booking_id', 'team_id', 'goals', 'assists'])]
class MatchPlayerStat extends Model
{

    public function match()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    public function player()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
