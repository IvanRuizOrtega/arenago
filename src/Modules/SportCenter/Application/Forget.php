<?php

namespace Src\Modules\SportCenter\Application;

use Src\Modules\SportCenter\Domain\Contracts\Forget as ForgetContract;

final class Forget
{
    private ForgetContract $contract;

    public function __construct(
        ForgetContract $contract
    ) {
        $this->contract = $contract;
    }

    public function __invoke(
        int | NULL $user_id = NULL,
        int $id,
    ): bool {
        return $this->contract->forget(
            user_id: $user_id,
            id: $id,
        );
    }
}
