<?php

namespace Src\Modules\User\Application;

use Src\Modules\User\Domain\Contracts\Show as ShowContract;

final class Show
{
    private ShowContract $contract;

    public function __construct(
        ShowContract $contract
    ) {
        $this->contract = $contract;
    }

    public function __invoke(
        int $id
    ): object {
        return $this->contract->show(
            id: $id,
        );
    }
}
