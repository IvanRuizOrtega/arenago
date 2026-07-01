<?php

namespace Src\Modules\PlayingField\Application;

use Src\Modules\PlayingField\Domain\Contracts\Forget as ForgetContract;

final class Forget
{
    private ForgetContract $contract;

    public function __construct(
        ForgetContract $contract
    ) {
        $this->contract = $contract;
    }

    public function __invoke(
        int $id,
        int $sport_center_id,
        int | NULL $user_id = NULL
    ) {
        return $this->contract->forget(
            id: $id,
            sport_center_id: $sport_center_id,
            user_id: $user_id
        );
    }
}
