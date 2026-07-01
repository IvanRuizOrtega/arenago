<?php

namespace Src\Modules\PlayingField\Domain\Contracts;

use Src\Modules\PlayingField\Domain\ValueObjects\VO;

interface Update
{
    public function update(
        int $id,
        int $sport_center_id,
        string $name,
        string $type,
        float $price_hour,
        bool $covered = FALSE
    ): VO;
}
