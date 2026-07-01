<?php

namespace Src\Modules\Booking\Domain\Contracts;


interface Index
{
    public function index(
        int $user_id
    );
}
