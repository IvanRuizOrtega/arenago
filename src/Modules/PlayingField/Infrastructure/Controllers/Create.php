<?php

namespace Src\Modules\PlayingField\Infrastructure\Controllers;

use Src\Modules\PlayingField\Application\Create as CreateCase;
use Src\Modules\PlayingField\Domain\ValueObjects\VO;

final class Create
{
    private CreateCase $case;

    public function __construct(
        CreateCase $case
    ) {
        $this->case = $case;
    }

    public function __invoke(
        ?int $sport_center_id,
        string $name,
        string $type,
        float $price_hour,
        bool $covered = FALSE
    ): VO {
        return $this->case->__invoke(
            name: $name,
            sport_center_id: $sport_center_id,
            type: $type,
            price_hour: $price_hour,
            covered: $covered,
        );
    }
}
