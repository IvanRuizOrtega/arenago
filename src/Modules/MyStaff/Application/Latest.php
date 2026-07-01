<?php

namespace Src\Modules\MyStaff\Application;

use Src\Modules\MyStaff\Domain\Contracts\Latest as LatestContract;
use Src\Modules\MyStaff\Domain\ValueObjects\VO;

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
