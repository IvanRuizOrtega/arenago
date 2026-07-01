<?php

namespace Src\Modules\PlayingField\Domain\Contracts;

/* use Src\Modules\PlayingField\Domain\ValueObjects\VO; */

interface AvailableHours
{
    public function available_hours(
        ?int $id,
        string $date,
        string $open,
        string $close,
    );
}
