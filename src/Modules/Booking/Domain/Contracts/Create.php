<?php

namespace Src\Modules\Booking\Domain\Contracts;

use Src\Modules\Booking\Domain\ValueObjects\VO;

interface Create
{
    public function create(
        int $userId,
        int $fieldId,
        string $startTime,
        int $durationHours = 1
    ): VO;
}
