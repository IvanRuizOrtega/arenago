<?php

namespace Src\Modules\Booking\Infrastructure\Controllers;

use Src\Modules\Booking\Application\Close as CloseCase;

final class Close
{
    private CloseCase $case;

    public function __construct(
        CloseCase $case
    ) {
        $this->case = $case;
    }

    public function __invoke(
        int $id,
        int $goals_a,
        int $goals_b,
        int $user_id,
        int $rating_service
    ) {
        return $this->case->__invoke(
            id: $id,
            goals_a: $goals_a,
            goals_b: $goals_b,
            user_id: $user_id,
            rating_service: $rating_service
        );
    }
}
