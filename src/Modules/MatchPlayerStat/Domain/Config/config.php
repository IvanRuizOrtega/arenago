<?php

use Src\Resources\Array\ParseToObject;

use Src\Modules\MatchPlayerStat\Application\{
    Index as IndexCase,
};
use Src\Modules\MatchPlayerStat\Domain\Contracts\{
    Index as IndexContract,
};
use Src\Modules\MatchPlayerStat\Infrastructure\Repositories\ORM\{
    Index as IndexRepository,
};


return ParseToObject::execute(array: [
    "repositories" => [
        ParseToObject::execute(array: [
            "case" => IndexCase::class,
            "contract" => IndexContract::class,
            "repository" => IndexRepository::class
        ]),
    ], "routes" => [
        "src/Modules/MatchPlayerStat/Domain/Routes/web.php"
    ]
]);
