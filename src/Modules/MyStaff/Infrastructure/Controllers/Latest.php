<?php

namespace Src\Modules\MyStaff\Infrastructure\Controllers;

use Src\Modules\MyStaff\Application\Latest as LatestCase;
use Src\Modules\MyStaff\Domain\ValueObjects\VO;

final class Latest
{
    private LatestCase $case;

    public function __construct(
        LatestCase $case
    ) {
        $this->case = $case;
    }

    public function __invoke(
        int $userId
    ): VO | NULL {
        return $this->case->__invoke(
            userId: $userId
        );
    }
}
