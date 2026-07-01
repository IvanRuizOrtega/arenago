<?php

namespace Src\Modules\SportCenter\Infrastructure\Controllers;

use Src\Modules\SportCenter\Application\All as AllCase;


final class All
{
    private AllCase $case;

    public function __construct(
        AllCase $case
    ) {
        $this->case = $case;
    }

    public function __invoke()
    {
        return $this->case->__invoke();
    }
}
