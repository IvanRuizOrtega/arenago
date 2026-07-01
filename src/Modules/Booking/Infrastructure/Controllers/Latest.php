<?php

namespace Src\Modules\Booking\Infrastructure\Controllers;

use Src\Modules\Booking\Application\Latest as LatestCase;
use Src\Modules\Booking\Domain\ValueObjects\VO;

final class Latest
{
    private LatestCase $case;

    public function __construct(
        LatestCase $case
    ) {
        $this->case = $case;
    }

    public function __invoke(
        int $userId
    ): VO | NULL {
        return $this->case->__invoke(
            userId: $userId
        );
    }
}
