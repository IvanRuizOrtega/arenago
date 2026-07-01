<?php

namespace Src\Modules\PlayingField\Infrastructure\Controllers;

use Src\Modules\PlayingField\Application\AvailableHours as AvailableHoursCase;

final class AvailableHours
{
    private AvailableHoursCase $case;

    public function __construct(
        AvailableHoursCase $case
    ) {
        $this->case = $case;
    }

    public function __invoke(
        ?int $id,
        string $date,
        string $open,
        string $close,
    ) {
        return $this->case->__invoke(
            id: $id,
            date: $date,
            open: $open,
            close: $close,
        );
    }
}
