<?php

namespace Src\Modules\User\Application;

use Src\Modules\User\Domain\Contracts\Index as IndexContract;

final class Index
{
    private IndexContract $contract;

    public function __construct(
        IndexContract $contract
    ) {
        $this->contract = $contract;
    }

    public function __invoke(
        string | NULL $search = NULL
    ) {
        return $this->contract->index(
            search: $search,
        );
    }
}
