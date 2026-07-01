<?php

namespace Src\Modules\MyStaff\Domain\Contracts;

use Src\Modules\MyStaff\Domain\ValueObjects\VO;

interface Latest
{
    public function latest(
        int $userId
    ): VO | NULL;
}
