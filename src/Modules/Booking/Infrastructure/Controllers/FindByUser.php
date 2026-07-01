<?php

namespace Src\Modules\Booking\Infrastructure\Controllers;

use Src\Modules\Booking\Application\FindByUser as FindByUserCase;

final class FindByUser
{
    private FindByUserCase $case;

    public function __construct(
        FindByUserCase $case
    ) {
        $this->case = $case;
    }

    public function __invoke(
        int $id,
        int $user_id
    ) {
        return $this->case->__invoke(
            id: $id,
            user_id: $user_id,
        );
    }
}
