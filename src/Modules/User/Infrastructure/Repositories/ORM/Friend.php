<?php

namespace Src\Modules\User\Infrastructure\Repositories\ORM;

use App\Models\User;
use Src\Modules\User\Domain\Contracts\Friend as FriendContract;

final class Friend
implements FriendContract
{
    private User $model;

    public function __construct(
        User $model,
    ) {
        $this->model = $model;
    }

    public function async_friend(
        int $user_id,
        int $friend_id,
    ) {
        $user = $this->model->where('id', $user_id)->first();
        if ($user) $user->friends()->syncWithoutDetaching($friend_id);
    }
}
