<?php

namespace Src\Modules\SportCenter\Application;

use Src\Modules\SportCenter\Domain\Contracts\Show as ShowContract;

final class Show
{
    private ShowContract $contract;

    public function __construct(
        ShowContract $contract
    ) {
        $this->contract = $contract;
    }

    public function __invoke(
        int $id,
        int | NULL $user_id = NULL,
    ) {
        return $this->contract->show(
            id: $id,
            user_id: $user_id
        );
    }
}
