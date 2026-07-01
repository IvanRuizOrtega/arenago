<?php

namespace Src\Modules\SportCenter\Infrastructure\Controllers;

use Src\Modules\SportCenter\Application\FindOne as FindOneCase;

final class FindOne
{
    private FindOneCase $case;

    public function __construct(
        FindOneCase $case
    ) {
        $this->case = $case;
    }

    public function __invoke(
        int $id,
        int | NULL $user_id = NULL,
    ) {
        return $this->case->__invoke(
            user_id: $user_id,
            id: $id,
        );
    }
}
