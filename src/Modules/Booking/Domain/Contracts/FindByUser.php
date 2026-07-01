<?php

namespace Src\Modules\Booking\Domain\Contracts;


interface FindByUser
{
    public function find_by_user(
        int $id,
        int $user_id
    );
}
