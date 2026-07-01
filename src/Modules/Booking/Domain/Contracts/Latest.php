<?php

namespace Src\Modules\Booking\Domain\Contracts;

use Src\Modules\Booking\Domain\ValueObjects\VO;

interface Latest
{
    public function latest(
        int $userId
    ): VO | NULL;
}
