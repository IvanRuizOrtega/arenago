<?php

namespace Src\Modules\SportCenter\Infrastructure\Controllers;

use Src\Modules\SportCenter\Application\Played as PlayedCase;

final class Played
{
    private PlayedCase $case;

    public function __construct(
        PlayedCase $case
    ) {
        $this->case = $case;
    }

    public function __invoke(
        ?int $user_id,
        ?string $year
    ) {
        return $this->case->__invoke(
            user_id: $user_id,
            year: $year
        );
    }
}
