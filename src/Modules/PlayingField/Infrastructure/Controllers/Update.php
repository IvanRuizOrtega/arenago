<?php

namespace Src\Modules\PlayingField\Infrastructure\Controllers;

use Src\Modules\PlayingField\Application\Update as UpdateCase;
use Src\Modules\PlayingField\Domain\ValueObjects\VO;

final class Update
{
    private UpdateCase $case;

    public function __construct(
        UpdateCase $case
    ) {
        $this->case = $case;
    }

    public function __invoke(
        int $id,
        int $sport_center_id,
        string $name,
        string $type,
        float $price_hour,
        bool $covered = FALSE
    ): VO {
        return $this->case->__invoke(
            id: $id,
            name: $name,
            sport_center_id: $sport_center_id,
            type: $type,
            price_hour: $price_hour,
            covered: $covered,
        );
    }
}
