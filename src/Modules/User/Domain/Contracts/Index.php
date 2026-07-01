<?php

namespace Src\Modules\User\Domain\Contracts;


interface Index
{
    public function index(
        string | NULL $search = NULL,
    );
}
