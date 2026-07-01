<?php

namespace Src\Modules\Booking\Application;

use Src\Modules\Booking\Domain\Contracts\Latest as LatestContract;
use Src\Modules\Booking\Domain\ValueObjects\VO;

final class Latest
{
    private LatestContract $contract;

    public function __construct(
        LatestContract $contract
    ) {
        $this->contract = $contract;
    }

    public function __invoke(
        int $userId,
    ): VO | NULL {
        return $this->contract->latest(
            userId: $userId
        );
    }
}
