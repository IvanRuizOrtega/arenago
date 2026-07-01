<?php

namespace Src\Modules\MatchPlayerStat\Domain\Contracts;

interface Index
{
    public function index(
        int $userId,
        string | NULL $current_year = NULL,
        int | NULL $sport_center = NULL
    ): array | NULL;
}
