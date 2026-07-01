<?php

namespace Src\Modules\User\Domain\Contracts;


interface Friend
{
    public function async_friend(
        int $user_id,
        int $friend_id,
    );
}
