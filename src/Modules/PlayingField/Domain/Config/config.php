<?php

use Src\Resources\Array\ParseToObject;

use Src\Modules\PlayingField\Application\{
    Create as CreateCase,
    Update as UpdateCase,
    Forget as ForgetCase,
    AvailableHours as AvailableHoursCase,
    Show as ShowCase
};
use Src\Modules\PlayingField\Domain\Contracts\{
    Create as CreateContract,
    Update as UpdateContract,
    Forget as ForgetContract,
    AvailableHours as AvailableHoursContract,
    Show as ShowContract
};
use Src\Modules\PlayingField\Infrastructure\Repositories\ORM\{
    Create as CreateRepository,
    Update as UpdateRepository,
    Forget as ForgetRepository,
    AvailableHours as AvailableHoursRepository,
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
            "case" => UpdateCase::class,
            "contract" => UpdateContract::class,
            "repository" => UpdateRepository::class
        ]),
        ParseToObject::execute(array: [
            "case" => ForgetCase::class,
            "contract" => ForgetContract::class,
            "repository" => ForgetRepository::class
        ]),
        ParseToObject::execute(array: [
            "case" => AvailableHoursCase::class,
            "contract" => AvailableHoursContract::class,
            "repository" => AvailableHoursRepository::class
        ]),
        ParseToObject::execute(array: [
            "case" => ShowCase::class,
            "contract" => ShowContract::class,
            "repository" => ShowRepository::class
        ])
    ], "routes" => [
        "src/Modules/PlayingField/Domain/Routes/web.php"
    ]
]);
