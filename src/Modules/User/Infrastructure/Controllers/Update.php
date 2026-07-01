<?php

namespace Src\Modules\User\Infrastructure\Controllers;

use Src\Modules\User\Application\Update as UpdateCase;

final class Update
{
    private UpdateCase $case;

    public function __construct(
        UpdateCase $case
    ) {
        $this->case = $case;
    }

    public function __invoke(
        int $id,
        ?array $roles = [],
        ?array $sport_centers = []
    ) {
        return $this->case->__invoke(
            id: $id,
            roles: $roles,
            sport_centers: $sport_centers
        );
    }
}
