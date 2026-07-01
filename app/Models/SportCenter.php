<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'address', 'city', 'lat', 'long', 'working_days', 'is_public'])]
class SportCenter extends Model
{
    use HasFactory;

    protected $casts = [
        'working_days' => 'array',
        'is_public' => 'boolean',
    ];

    public function scopeNearby($query, $lat, $lng, $distanceInKm = 10)
    {
        $latDelta = $distanceInKm / 111.32;

        $lngDelta = $distanceInKm /
            (111.32 * cos(deg2rad($lat)));

        return $query
            ->whereBetween('lat', [
                $lat - $latDelta,
                $lat + $latDelta
            ])
            ->whereBetween('long', [
                $lng - $lngDelta,
                $lng + $lngDelta
            ]);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function playingFields()
    {
        return $this->hasMany(PlayingField::class);
    }
}
