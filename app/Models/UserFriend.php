<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;


#[Fillable(['user_id', 'friend_id'])]
class UserFriend extends Model
{
    //
}
