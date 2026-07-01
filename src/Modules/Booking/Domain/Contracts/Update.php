<?php

namespace Src\Modules\Booking\Domain\Contracts;


interface Update
{
    public function update(
        int $id,
        string $action,
        int $user_id
    );
}
