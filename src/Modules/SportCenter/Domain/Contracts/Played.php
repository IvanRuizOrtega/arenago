<?php

namespace Src\Modules\SportCenter\Domain\Contracts;


interface Played
{
    public function played(
        ?int $user_id,
        ?string $year
    );
}
