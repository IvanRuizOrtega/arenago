<?php

namespace Src\Modules\SportCenter\Infrastructure\Controllers;

use Src\Modules\SportCenter\Application\Update as UpdateCase;

final class Update
{
    private UpdateCase $case;

    public function __construct(
        UpdateCase $case
    ) {
        $this->case = $case;
    }

    public function __invoke(
        int $id,
        string $name,
        string $address,
        string $city,
        float $lat,
        float $long,
        ?array $working_days,
        bool $is_public = FALSE
    ): bool {
        return $this->case->__invoke(
            id: $id,
            name: $name,
            address: $address,
            city: $city,
            lat: $lat,
            long: $long,
            working_days: $working_days,
            is_public: $is_public
        );
    }
}
