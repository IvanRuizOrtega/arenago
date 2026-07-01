<?php

namespace Src\Modules\MatchPlayerStat\Application;

use Src\Modules\MatchPlayerStat\Domain\Contracts\Index as IndexContract;

final class Index
{
    private IndexContract $contract;

    public function __construct(
        IndexContract $contract
    ) {
        $this->contract = $contract;
    }

    public function __invoke(
        int $userId,
        string | NULL $current_year = NULL,
        int | NULL $sport_center = NULL
    ): array | NULL {
        return $this->contract->index(
            userId: $userId,
            current_year: $current_year,
            sport_center: $sport_center
        );
    }
}
