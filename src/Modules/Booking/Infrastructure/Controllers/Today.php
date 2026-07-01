<?php

namespace Src\Modules\Booking\Infrastructure\Controllers;

use Src\Modules\Booking\Application\Today as TodayCase;

final class Today
{
    private TodayCase $case;

    public function __construct(
        TodayCase $case
    ) {
        $this->case = $case;
    }

    public function __invoke(
        int $user_id,
        string $day,
        ?string $user
    ) {
        return $this->case->__invoke(
            user_id: $user_id,
            day: $day,
            user: $user
        );
    }
}
