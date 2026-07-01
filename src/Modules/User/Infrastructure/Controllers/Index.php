<?php

namespace Src\Modules\User\Infrastructure\Controllers;

use Src\Modules\User\Application\Index as IndexCase;

final class Index
{
    private IndexCase $case;

    public function __construct(
        IndexCase $case
    ) {
        $this->case = $case;
    }

    public function __invoke(
        string | NULL $search = NULL
    ) {
        return $this->case->__invoke(
            search: $search,
        );
    }
}
