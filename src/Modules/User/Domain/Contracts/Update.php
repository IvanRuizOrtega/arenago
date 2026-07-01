<?php

namespace Src\Modules\User\Domain\Contracts;


interface Update
{
    public function update(
        int $id,
        ?array $roles = [],
        ?array $sport_centers = []
    );
}
