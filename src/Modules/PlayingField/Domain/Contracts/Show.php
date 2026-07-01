<?php

namespace Src\Modules\PlayingField\Domain\Contracts;


interface Show
{
    public function show(
        int $id,
        int $sport_center_id,
        int | NULL $user_id = NULL,
    );
}
