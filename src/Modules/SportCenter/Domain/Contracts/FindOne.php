<?php

namespace Src\Modules\SportCenter\Domain\Contracts;


interface FindOne
{
    public function find_one(
        int $id,
        int | NULL $user_id = NULL,
    );
}
