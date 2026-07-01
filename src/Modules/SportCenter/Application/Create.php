<?php

namespace Src\Modules\SportCenter\Application;

use Src\Modules\SportCenter\Domain\Contracts\Create as CreateContract;
use Src\Modules\SportCenter\Domain\ValueObjects\VO;

final class Create
{
    private CreateContract $contract;

    public function __construct(
        CreateContract $contract
    ) {
        $this->contract = $contract;
    }

    public function __invoke(
        string $name,
        string $address,
        string $city,
        float $lat,
        float $long,
        ?array $working_days,
        bool $is_public = FALSE
    ): VO {
        return $this->contract->create(
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
