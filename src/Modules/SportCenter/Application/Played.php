<?php

namespace Src\Modules\SportCenter\Application;

use Src\Modules\SportCenter\Domain\Contracts\Played as PlayedContract;

final class Played
{
    private PlayedContract $contract;

    public function __construct(
        PlayedContract $contract
    ) {
        $this->contract = $contract;
    }

    public function __invoke(
        ?int $user_id,
        ?string $year
    ) {
        return $this->contract->played(
            user_id: $user_id,
            year: $year
        );
    }
}
