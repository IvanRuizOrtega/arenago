<?php

namespace Src\Modules\User\Infrastructure\Controllers;

use Src\Modules\User\Application\Friend as FriendCase;

final class Friend
{
    private FriendCase $case;

    public function __construct(
        FriendCase $case
    ) {
        $this->case = $case;
    }

    public function __invoke(
        int $user_id,
        int $friend_id,
    ) {
        return $this->case->__invoke(
            user_id: $user_id,
            friend_id: $friend_id,
        );
    }
}
