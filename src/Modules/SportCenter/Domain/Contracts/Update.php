<?php

namespace Src\Modules\SportCenter\Domain\Contracts;


interface Update
{
    public function update(
        int $id,
        string $name,
        string $address,
        string $city,
        float $lat,
        float $long,
        ?array $working_days,
        bool $is_public = FALSE
    ): bool;
}
