<?php

namespace Src\Modules\Booking\Domain\Contracts;


interface Close
{
    public function close(
        int $id,
        int $goals_a,
        int $goals_b,
        int $user_id,
        int $rating_service
    );
}
