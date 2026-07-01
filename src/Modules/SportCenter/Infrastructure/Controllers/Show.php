<?php

namespace Src\Modules\SportCenter\Infrastructure\Controllers;

use Src\Modules\SportCenter\Application\Show as ShowCase;

final class Show
{
    private ShowCase $case;

    public function __construct(
        ShowCase $case
    ) {
        $this->case = $case;
    }

    public function __invoke(
        int $id,
        int | NULL $user_id = NULL,
    ) {
        return $this->case->__invoke(
            id: $id,
            user_id: $user_id
        );
    }
}
