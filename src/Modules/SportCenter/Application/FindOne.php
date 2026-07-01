<?php

namespace Src\Modules\SportCenter\Application;

use Src\Modules\SportCenter\Domain\Contracts\FindOne as FindOneContract;

final class FindOne
{
    private FindOneContract $contract;

    public function __construct(
        FindOneContract $contract
    ) {
        $this->contract = $contract;
    }

    public function __invoke(
        int $id,
        int | NULL $user_id = NULL,
    ) {
        return $this->contract->find_one(
            user_id: $user_id,
            id: $id,
        );
    }
}
