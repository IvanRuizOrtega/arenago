<?php

namespace Src\Modules\PlayingField\Application;

use Src\Modules\PlayingField\Domain\Contracts\Update as UpdateContract;
use Src\Modules\PlayingField\Domain\ValueObjects\VO;

final class Update
{
    private UpdateContract $contract;

    public function __construct(
        UpdateContract $contract
    ) {
        $this->contract = $contract;
    }

    public function __invoke(
        int $id,
        int $sport_center_id,
        string $name,
        string $type,
        float $price_hour,
        bool $covered = FALSE
    ): VO {
        return $this->contract->update(
            id: $id,
            name: $name,
            sport_center_id: $sport_center_id,
            type: $type,
            price_hour: $price_hour,
            covered: $covered,
        );
    }
}
