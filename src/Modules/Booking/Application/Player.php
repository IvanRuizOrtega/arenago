<?php

namespace Src\Modules\Booking\Application;

use Src\Modules\Booking\Domain\Contracts\Player as PlayerContract;

final class Player
{
    private PlayerContract $contract;

    public function __construct(
        PlayerContract $contract
    ) {
        $this->contract = $contract;
    }

    public function __invoke(
        int $booking_id,
        string | NULL $search = NULL,
        int | null $user_id = NULL
    ) {
        return $this->contract->player(
            booking_id: $booking_id,
            search: $search,
            user_id: $user_id
        );
    }
}
