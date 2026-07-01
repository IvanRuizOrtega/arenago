<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'user_id',
    'matches_played',
    'wins',
    'draws',
    'losses',
    'points',
    'rating'
])]
class PlayerRanking extends Model
{
    public function player()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
