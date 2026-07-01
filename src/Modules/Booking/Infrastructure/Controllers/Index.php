<?php

namespace Src\Modules\Booking\Infrastructure\Controllers;

use Src\Modules\Booking\Application\Index as IndexCase;

final class Index
{
    private IndexCase $case;

    public function __construct(
        IndexCase $case
    ) {
        $this->case = $case;
    }

    public function __invoke(
        int $user_id
    ) {
        return $this->case->__invoke(
            user_id: $user_id,
        );
    }
}
