<?php

namespace Src\Modules\User\Application;

use Src\Modules\User\Domain\Contracts\Friend as FriendContract;

final class Friend
{
    private FriendContract $contract;

    public function __construct(
        FriendContract $contract
    ) {
        $this->contract = $contract;
    }

    public function __invoke(
        int $user_id,
        int $friend_id,
    ) {
        return $this->contract->async_friend(
            user_id: $user_id,
            friend_id: $friend_id,
        );
    }
}
