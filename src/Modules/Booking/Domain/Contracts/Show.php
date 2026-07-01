<?php

namespace Src\Modules\Booking\Domain\Contracts;


interface Show
{
    public function show(
        int $sport_center,
        int $playing_field,
        int | NULL $user_id = NULL
    );
}
