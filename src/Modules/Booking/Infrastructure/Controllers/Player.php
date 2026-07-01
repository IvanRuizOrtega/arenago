<?php

namespace Src\Modules\Booking\Infrastructure\Controllers;

use Src\Modules\Booking\Application\Player as PlayerCase;

final class Player
{
    private PlayerCase $case;

    public function __construct(
        PlayerCase $case
    ) {
        $this->case = $case;
    }

    public function __invoke(
        int $booking_id,
        string | NULL $search = NULL,
        int | null $user_id = NULL
    ) {
        return $this->case->__invoke(
            booking_id: $booking_id,
            search: $search,
            user_id: $user_id
        );
    }
}
