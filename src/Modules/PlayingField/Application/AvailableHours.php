<?php

namespace Src\Modules\PlayingField\Application;

use Src\Modules\PlayingField\Domain\Contracts\AvailableHours as AvailableHoursContract;

final class AvailableHours
{
    private AvailableHoursContract $contract;

    public function __construct(
        AvailableHoursContract $contract
    ) {
        $this->contract = $contract;
    }

    public function __invoke(
        ?int $id,
        string $date,
        string $open,
        string $close,
    ) {
        return $this->contract->available_hours(
            id: $id,
            date: $date,
            open: $open,
            close: $close,
        );
    }
}
