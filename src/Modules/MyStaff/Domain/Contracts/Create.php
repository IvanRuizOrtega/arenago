<?php

namespace Src\Modules\MyStaff\Domain\Contracts;

use Src\Modules\MyStaff\Domain\ValueObjects\VO;

interface Create
{
    public function create(
        int $userId,
        int $fieldId,
        string $startTime,
        int $durationHours = 1
    ): VO;
}
