<?php

namespace Src\Modules\SportCenter\Application;

use Src\Modules\SportCenter\Domain\Contracts\Index as IndexContract;

final class Index
{
    private IndexContract $contract;

    public function __construct(
        IndexContract $contract
    ) {
        $this->contract = $contract;
    }

    public function __invoke(
        string $lat,
        string $long,
        int | NULL $user_id = NULL,
        string | NULL $search = NULL,
        int $paginate = 10,
        ...$attributes,
    ) {
        return $this->contract->index(
            lat: $lat,
            long: $long,
            user_id: $user_id,
            search: $search,
            paginate: $paginate,
            attributes: $attributes,
        );
    }
}
