<?php

namespace Src\Modules\SportCenter\Application;

use Src\Modules\SportCenter\Domain\Contracts\My as MyContract;

final class My
{
    private MyContract $contract;

    public function __construct(
        MyContract $contract
    ) {
        $this->contract = $contract;
    }

    public function __invoke(
        ?int $user_id,
    ) {
        return $this->contract->my(
            user_id: $user_id,
        );
    }
}
