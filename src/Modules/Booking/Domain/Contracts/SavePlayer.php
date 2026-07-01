<?php

namespace Src\Modules\Booking\Domain\Contracts;


interface SavePlayer
{
    public function save_player(
        int $id,
        int $user_id,
        array $team_a,
        array $team_b
    );
}
