<?php

namespace Src\Modules\Booking\Domain\Contracts;


interface Player
{
    public function player(
        int $booking_id,
        string | NULL $search = NULL,
        int |  null $user_id = NULL
    );
}
