<?php

namespace Src\Modules\User\Domain\Contracts;


interface Show
{
    public function show(
        int $id,
    ): object;
}
