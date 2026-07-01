<?php

namespace Src\Modules\Booking\Infrastructure\Controllers;

use Src\Modules\Booking\Application\Update as UpdateCase;

final class Update
{
    private UpdateCase $case;

    public function __construct(
        UpdateCase $case
    ) {
        $this->case = $case;
    }

    public function __invoke(
        int $id,
        string $action,
        int $user_id
    ) {
        return $this->case->__invoke(
            id: $id,
            action: $action,
            user_id: $user_id,
        );
    }
}
