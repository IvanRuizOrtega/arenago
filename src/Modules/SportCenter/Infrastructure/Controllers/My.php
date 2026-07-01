<?php

namespace Src\Modules\SportCenter\Infrastructure\Controllers;

use Src\Modules\SportCenter\Application\My as MYCase;

final class My
{
    private MyCase $case;

    public function __construct(
        MyCase $case
    ) {
        $this->case = $case;
    }

    public function __invoke(
        ?int $user_id,
    ) {
        return $this->case->__invoke(
            user_id: $user_id,
        );
    }
}
