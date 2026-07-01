<?php

namespace Src\Modules\PlayingField\Application;

use Src\Modules\PlayingField\Domain\Contracts\Show as ShowContract;

final class Show
{
    private ShowContract $contract;

    public function __construct(
        ShowContract $contract
    ) {
        $this->contract = $contract;
    }

    public function __invoke(
        int $id,
        int $sport_center_id,
        int | NULL $user_id = NULL,
    ) {
        return $this->contract->show(
            id: $id,
            sport_center_id: $sport_center_id,
            user_id: $user_id
        );
    }
}
