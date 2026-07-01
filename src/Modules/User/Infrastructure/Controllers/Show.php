<?php

namespace Src\Modules\User\Infrastructure\Controllers;

use Src\Modules\User\Application\Show as ShowCase;

final class Show
{
    private ShowCase $case;

    public function __construct(
        ShowCase $case
    ) {
        $this->case = $case;
    }

    public function __invoke(
        int $id
    ): object {
        return $this->case->__invoke(
            id: $id,
        );
    }
}
