<?php

namespace Src\Modules\Booking\Application;

use Src\Modules\Booking\Domain\Contracts\Show as ShowContract;

final class Show
{
    private ShowContract $contract;

    public function __construct(
        ShowContract $contract
    ) {
        $this->contract = $contract;
    }

    public function __invoke(
        int $sport_center,
        int $playing_field,
        int | NULL $user_id = NULL
    ) {
        return $this->contract->show(
            sport_center: $sport_center,
            playing_field: $playing_field,
            user_id: $user_id,
        );
    }
}
