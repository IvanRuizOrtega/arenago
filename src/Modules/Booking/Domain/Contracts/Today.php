<?php

namespace Src\Modules\Booking\Domain\Contracts;


interface Today
{
    public function today(int $user_id, string $day, ?string $user);
}
