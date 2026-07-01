<?php

namespace Src\Modules\SportCenter\Domain\Contracts;


interface Index
{
    public function index(
        string $lat,
        string $long,
        int | NULL $user_id = NULL,
        string | NULL $search = NULL,
        int $paginate = 10,
        ...$attributes
    );
}
