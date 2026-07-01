<?php

namespace Src\Modules\User\Application;

use Src\Modules\User\Domain\Contracts\Update as UpdateContract;

final class Update
{
    private UpdateContract $contract;

    public function __construct(
        UpdateContract $contract
    ) {
        $this->contract = $contract;
    }

    public function __invoke(
        int $id,
        ?array $roles = [],
        ?array $sport_centers = []
    ) {
        return $this->contract->update(
            id: $id,
            roles: $roles,
            sport_centers: $sport_centers
        );
    }
}
