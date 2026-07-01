<?php

namespace Src\Modules\SportCenter\Infrastructure\Controllers;

use Src\Modules\SportCenter\Application\Create as CreateCase;
use Src\Modules\SportCenter\Domain\ValueObjects\VO;

final class Create
{
    private CreateCase $case;

    public function __construct(
        CreateCase $case
    ) {
        $this->case = $case;
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
        return $this->case->__invoke(
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
