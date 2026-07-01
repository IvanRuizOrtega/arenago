<?php

namespace Src\Modules\SportCenter\Infrastructure\Controllers;

use Src\Modules\SportCenter\Application\Index as IndexCase;


final class Index
{
    private IndexCase $case;

    public function __construct(
        IndexCase $case
    ) {
        $this->case = $case;
    }

    public function __invoke(
        string $lat,
        string $long,
        int | NULL $user_id = NULL,
        string | NULL $search = NULL,
        int $paginte = 10,
        ...$attributes,
    ) {
        return $this->case->__invoke(
            lat: $lat,
            long: $long,
            user_id: $user_id,
            search: $search,
            paginate: $paginte,
            attributes: $attributes,
        );
    }
}
