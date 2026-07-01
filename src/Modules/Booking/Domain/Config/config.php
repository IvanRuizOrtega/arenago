<?php

use Src\Resources\Array\ParseToObject;

use Src\Modules\Booking\Application\{
    Create as CreateCase,
    Show as ShowCase,
    Index as IndexCase,
    FindByUser as FindByUserCase,
    Player as PlayerCase,
    SavePlayer as SavePlayerCase,
    Close as CloseCase,
    Update as UpdateCase,
    Latest as LatestCase,
    Today as TodayCase,
};
use Src\Modules\Booking\Domain\Contracts\{
    Create as CreateContract,
    Show as ShowContract,
    Index as IndexContract,
    FindByUser as FindByUserContract,
    Player as PlayerContract,
    SavePlayer as SavePlayerContract,
    Close as CloseContract,
    Update as UpdateContract,
    Latest as LatestContract,
    Today as TodayContract,
};
use Src\Modules\Booking\Infrastructure\Repositories\ORM\{
    Create as CreateRepository,
    Show as ShowRepository,
    Index as IndexRepository,
    FindByUser as FindByUserRepository,
    Player as PlayerRepository,
    SavePlayer as SavePlayerRepository,
    Close as CloseRepository,
    Update as UpdateRepository,
    Latest as LatestRepository,
    Today as TodayRepository,
};


return ParseToObject::execute(array: [
    "repositories" => [
        parsetoobject::execute(array: [
            "case" => CreateCase::class,
            "contract" => CreateContract::class,
            "repository" => CreateRepository::class
        ]),
        parsetoobject::execute(array: [
            "case" => ShowCase::class,
            "contract" => ShowContract::class,
            "repository" => ShowRepository::class
        ]),
        parsetoobject::execute(array: [
            "case" => IndexCase::class,
            "contract" => IndexContract::class,
            "repository" => IndexRepository::class
        ]),
        parsetoobject::execute(array: [
            "case" => FindByUserCase::class,
            "contract" => FindByUserContract::class,
            "repository" => FindByUserRepository::class
        ]),
        parsetoobject::execute(array: [
            "case" => PlayerCase::class,
            "contract" => PlayerContract::class,
            "repository" => PlayerRepository::class
        ]),
        parsetoobject::execute(array: [
            "case" => SavePlayerCase::class,
            "contract" => SavePlayerContract::class,
            "repository" => SavePlayerRepository::class
        ]),
        parsetoobject::execute(array: [
            "case" => CloseCase::class,
            "contract" => CloseContract::class,
            "repository" => CloseRepository::class
        ]),
        parsetoobject::execute(array: [
            "case" => UpdateCase::class,
            "contract" => UpdateContract::class,
            "repository" => UpdateRepository::class
        ]),
        ParseToObject::execute(array: [
            "case" => LatestCase::class,
            "contract" => LatestContract::class,
            "repository" => LatestRepository::class
        ]),
        ParseToObject::execute(array: [
            "case" => TodayCase::class,
            "contract" => TodayContract::class,
            "repository" => TodayRepository::class
        ]),
    ], "routes" => [
        "src/Modules/Booking/Domain/Routes/web.php"
    ]
]);
