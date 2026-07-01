<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'google_id', 'google_token', 'google_avatar', 'username'])]
#[Hidden(['google_token', 'google_id'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    // /**
    //  * Get the attributes that should be cast.
    //  *
    //  * @return array<string, string>
    //  */
    // protected function casts(): array
    // {
    //     return [
    //         'email_verified_at' => 'datetime',
    //         // 'password' => 'hashed',
    //     ];
    // }
    protected static function booted()
    {
        static::created(function ($user) {
            $user->update([
                'username' => 'player' . $user->id
            ]);
        });
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function sport_centers()
    {
        return $this->belongsToMany(SportCenter::class);
    }

    public function matchStats()
    {
        return $this->hasMany(MatchPlayerStat::class);
    }

    public function ranking()
    {
        return $this->hasOne(PlayerRanking::class);
    }

    public function attendedBookings()
    {
        return $this->hasMany(Booking::class, 'attended_by');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function friends()
    {
        return $this->belongsToMany(User::class, 'user_friends', 'user_id', 'friend_id')
            ->withTimestamps();
    }
}
