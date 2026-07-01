<?php

namespace Src\Modules\SportCenter\Domain\Contracts;


interface Forget
{
    public function forget(
        int | NULL $user_id = NULL,
        int $id,
    ): bool;
}
