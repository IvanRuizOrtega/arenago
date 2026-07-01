<?php

namespace Src\Modules\SportCenter\Domain\Contracts;


interface Show
{
    public function show(
        int $id,
        int | NULL $user_id = NULL,
    );
}
