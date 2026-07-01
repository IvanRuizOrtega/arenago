<?php

namespace Src\Modules\SportCenter\Application;

use Src\Modules\SportCenter\Domain\Contracts\Update as UpdateContract;

final class Update
{
    private UpdateContract $contract;

    public function __construct(
        UpdateContract $contract
    ) {
        $this->contract = $contract;
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
        return $this->contract->update(
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
