<?php

namespace Src\Modules\Booking\Application;

use Src\Modules\Booking\Domain\Contracts\Create as CreateContract;
use Src\Modules\Booking\Domain\ValueObjects\VO;

final class Create
{
    private CreateContract $contract;

    public function __construct(
        CreateContract $contract
    ) {
        $this->contract = $contract;
    }

    public function __invoke(
        int $userId,
        int $fieldId,
        string $startTime,
        int $durationHours = 1
    ): VO {
        return $this->contract->create(
            userId: $userId,
            fieldId: $fieldId,
            startTime: $startTime,
            durationHours: $durationHours,
        );
    }
}
