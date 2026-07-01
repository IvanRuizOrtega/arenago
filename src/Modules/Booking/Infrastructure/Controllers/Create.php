<?php

namespace Src\Modules\Booking\Infrastructure\Controllers;

use Src\Modules\Booking\Application\Create as CreateCase;
use Src\Modules\Booking\Domain\ValueObjects\VO;

final class Create
{
    private CreateCase $case;

    public function __construct(
        CreateCase $case
    ) {
        $this->case = $case;
    }

    public function __invoke(
        int $userId,
        int $fieldId,
        string $startTime,
        int $durationHours = 1
    ): VO {
        return $this->case->__invoke(
            userId: $userId,
            fieldId: $fieldId,
            startTime: $startTime,
            durationHours: $durationHours,
        );
    }
}
