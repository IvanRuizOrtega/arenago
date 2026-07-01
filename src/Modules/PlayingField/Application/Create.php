<?php

namespace Src\Modules\PlayingField\Application;

use Src\Modules\PlayingField\Domain\Contracts\Create as CreateContract;
use Src\Modules\PlayingField\Domain\ValueObjects\VO;

final class Create
{
    private CreateContract $contract;

    public function __construct(
        CreateContract $contract
    ) {
        $this->contract = $contract;
    }

    public function __invoke(
        ?int $sport_center_id,
        string $name,
        string $type,
        float $price_hour,
        bool $covered = FALSE
    ): VO {
        return $this->contract->create(
            name: $name,
            sport_center_id: $sport_center_id,
            type: $type,
            price_hour: $price_hour,
            covered: $covered,
        );
    }
}
