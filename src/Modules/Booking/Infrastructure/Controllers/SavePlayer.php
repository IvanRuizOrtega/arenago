<?php

namespace Src\Modules\Booking\Infrastructure\Controllers;

use Src\Modules\Booking\Application\SavePlayer as SavePlayerCase;

final class SavePlayer
{
    private SavePlayerCase $case;

    public function __construct(
        SavePlayerCase $case
    ) {
        $this->case = $case;
    }

    public function __invoke(
        int $id,
        int $user_id,
        array $team_a,
        array $team_b
    ) {
        return $this->case->__invoke(
            id: $id,
            user_id: $user_id,
            team_a: $team_a,
            team_b: $team_b
        );
    }
}
