<?php

namespace Src\Modules\MatchPlayerStat\Infrastructure\Controllers;

use Src\Modules\MatchPlayerStat\Application\Index as LatestCase;

final class Index
{
    private LatestCase $case;

    public function __construct(
        LatestCase $case
    ) {
        $this->case = $case;
    }

    public function __invoke(
        int $userId,
        string | NULL $current_year = NULL,
        int | NULL $sport_center = NULL
    ): array | NULL {
        return $this->case->__invoke(
            userId: $userId,
            current_year: $current_year,
            sport_center: $sport_center
        );
    }
}
