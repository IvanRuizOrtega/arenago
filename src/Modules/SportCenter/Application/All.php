<?php

namespace Src\Modules\SportCenter\Application;

use Src\Modules\SportCenter\Domain\Contracts\All as AllContract;

final class All
{
    private AllContract $contract;

    public function __construct(
        AllContract $contract
    ) {
        $this->contract = $contract;
    }

    public function __invoke()
    {
        return $this->contract->all();
    }
}
