<?php

namespace Src\Modules\PlayingField\Infrastructure\Controllers;

use Src\Modules\PlayingField\Application\Forget as ForgetCase;

final class Forget
{
    private ForgetCase $case;

    public function __construct(
        ForgetCase $case
    ) {
        $this->case = $case;
    }

    public function __invoke(
        int $id,
        int $sport_center_id,
        int | NULL $user_id = NULL
    ) {
        return $this->case->__invoke(
            id: $id,
            sport_center_id: $sport_center_id,
            user_id: $user_id
        );
    }
}
