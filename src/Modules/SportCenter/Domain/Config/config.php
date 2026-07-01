<?php

use Src\Resources\Array\ParseToObject;

use Src\Modules\SportCenter\Application\{
    Create as CreateCase,
    My as MyCase,
    Played as PlayedCase,
    Index as IndexCase,
    All as AllCase,
    Forget as ForgetCase,
    FindOne as FindOneCase,
    Update as UpdateCase,
    Show as ShowCase
};
use Src\Modules\SportCenter\Domain\Contracts\{
    Create as CreateContract,
    My as MyContract,
    Played as PlayedContract,
    Index as IndexContract,
    All as AllContract,
    Forget as ForgetContract,
    FindOne as FindOneContract,
    Update as UpdateContract,
    Show as ShowContract
};
use Src\Modules\SportCenter\Infrastructure\Repositories\ORM\{
    Create as CreateRepository,
    My as MyRepository,
    Played as PlayedRepository,
    Index as IndexRepository,
    All as AllRepository,
    Forget as ForgetRepository,
    FindOne as FindOneRepository,
    Update as UpdateRepository,
    Show as ShowRepository
};


return ParseToObject::execute(array: [
    "repositories" => [
        ParseToObject::execute(array: [
            "case" => CreateCase::class,
            "contract" => CreateContract::class,
            "repository" => CreateRepository::class
        ]),
        ParseToObject::execute(array: [
            "case" => MyCase::class,
            "contract" => MyContract::class,
            "repository" => MyRepository::class
        ]),
        ParseToObject::execute(array: [
            "case" => PlayedCase::class,
            "contract" => PlayedContract::class,
            "repository" => PlayedRepository::class
        ]),
        ParseToObject::execute(array: [
            "case" => IndexCase::class,
            "contract" => IndexContract::class,
            "repository" => IndexRepository::class
        ]),
        ParseToObject::execute(array: [
            "case" => AllCase::class,
            "contract" => AllContract::class,
            "repository" => AllRepository::class
        ]),
        ParseToObject::execute(array: [
            "case" => ForgetCase::class,
            "contract" => ForgetContract::class,
            "repository" => ForgetRepository::class
        ]),
        ParseToObject::execute(array: [
            "case" => FindOneCase::class,
            "contract" => FindOneContract::class,
            "repository" => FindOneRepository::class
        ]),
        ParseToObject::execute(array: [
            "case" => UpdateCase::class,
            "contract" => UpdateContract::class,
            "repository" => UpdateRepository::class
        ]),
        ParseToObject::execute(array: [
            "case" => ShowCase::class,
            "contract" => ShowContract::class,
            "repository" => ShowRepository::class
        ]),
    ], "routes" => [
        "src/Modules/SportCenter/Domain/Routes/web.php"
    ]
]);
