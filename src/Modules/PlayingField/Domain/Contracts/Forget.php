<?php

namespace Src\Modules\PlayingField\Domain\Contracts;

interface Forget
{
    public function forget(
        int $id,
        int $sport_center_id,
        int | NULL $user_id = NULL
    );
}
