<?php

namespace Src\Modules\Booking\Application;

use Src\Modules\Booking\Domain\Contracts\Update as UpdateContract;

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
        string $action,
        int $user_id
    ) {
        return $this->contract->update(
            id: $id,
            action: $action,
            user_id: $user_id,
        );
    }
}
