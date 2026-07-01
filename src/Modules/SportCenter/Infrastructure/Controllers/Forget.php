<?php

namespace Src\Modules\SportCenter\Infrastructure\Controllers;

use Src\Modules\SportCenter\Application\Forget as ForgetCase;

final class Forget
{
    private ForgetCase $case;

    public function __construct(
        ForgetCase $case
    ) {
        $this->case = $case;
    }

    public function __invoke(
        int | NULL $user_id = NULL,
        int $id,
    ): bool {
        return $this->case->__invoke(
            user_id: $user_id,
            id: $id,
        );
    }
}
