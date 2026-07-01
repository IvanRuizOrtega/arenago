<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\Friend;
use Src\Modules\User\Infrastructure\Controllers\Friend as ControllersFriend;

class UserFriendController extends Controller
{
    public function toggle(Friend $rq, ControllersFriend $ctr)
    {
        $user_id = getPropertyAuth(property: 'id') ?: $rq->user_id;
        $ctr->__invoke(user_id: $user_id, friend_id: $rq->friend_id);
        return response()->json([]);
    }
}
