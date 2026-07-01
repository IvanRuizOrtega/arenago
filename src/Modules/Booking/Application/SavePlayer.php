<?php

namespace Src\Modules\Booking\Application;

use Src\Modules\Booking\Domain\Contracts\SavePlayer as SavePlayerContract;

final class SavePlayer
{
    private SavePlayerContract $contract;

    public function __construct(
        SavePlayerContract $contract
    ) {
        $this->contract = $contract;
    }

    public function __invoke(
        int $id,
        int $user_id,
        array $team_a,
        array $team_b
    ) {
        return $this->contract->save_player(
            id: $id,
            user_id: $user_id,
            team_a: $team_a,
            team_b: $team_b
        );
    }
}
