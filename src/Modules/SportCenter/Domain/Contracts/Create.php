<?php

namespace Src\Modules\SportCenter\Domain\Contracts;

use Src\Modules\SportCenter\Domain\ValueObjects\VO;

interface Create
{
    public function create(
        string $name,
        string $address,
        string $city,
        float $lat,
        float $long,
        ?array $working_days,
        bool $is_public = FALSE
    ): VO;
}
