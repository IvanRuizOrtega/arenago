<?php

namespace Src\Modules\Booking\Application;

use Src\Modules\Booking\Domain\Contracts\FindByUser as FindByUserContract;

final class FindByUser
{
    private FindByUserContract $contract;

    public function __construct(
        FindByUserContract $contract
    ) {
        $this->contract = $contract;
    }

    public function __invoke(
        int $id,
        int $user_id
    ) {
        return $this->contract->find_by_user(
            id: $id,
            user_id: $user_id,
        );
    }
}
