<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['user_id', 'playing_field_id', 'date', 'start_time', 'end_time', 'status', 'total_price', 'attended_by', 'message', 'ranking'])]
class Booking extends Model
{
    public function playing_field()
    {
        return $this->belongsTo(PlayingField::class);
    }

    public function attendant()
    {
        return $this->belongsTo(User::class, 'attended_by');
    }

    public function requested()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function players()
    {
        return $this->belongsToMany(User::class, 'match_player_stats')
            ->withPivot('team_id', 'goals', 'assists')
            ->withTimestamps();
    }
}
