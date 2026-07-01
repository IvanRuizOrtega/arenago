<?php

namespace Src\Modules\MyStaff\Infrastructure\Controllers;

use Src\Modules\MyStaff\Application\Create as CreateCase;
use Src\Modules\MyStaff\Domain\ValueObjects\VO;

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
