<?php

namespace Src\Modules\Booking\Application;

use Src\Modules\Booking\Domain\Contracts\Close as CloseContract;

final class Close
{
    private CloseContract $contract;

    public function __construct(
        CloseContract $contract
    ) {
        $this->contract = $contract;
    }

    public function __invoke(
        int $id,
        int $goals_a,
        int $goals_b,
        int $user_id,
        int $rating_service
    ) {
        return $this->contract->close(
            id: $id,
            goals_a: $goals_a,
            goals_b: $goals_b,
            user_id: $user_id,
            rating_service: $rating_service
        );
    }
}
