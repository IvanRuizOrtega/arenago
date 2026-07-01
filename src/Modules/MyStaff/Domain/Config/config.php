<?php

use Src\Resources\Array\ParseToObject;

use Src\Modules\MyStaff\Application\{
    Create as CreateCase,
    Latest as LatestCase,
};
use Src\Modules\MyStaff\Domain\Contracts\{
    Create as CreateContract,
    Latest as LatestContract,
};
use Src\Modules\MyStaff\Infrastructure\Repositories\ORM\{
    Create as CreateRepository,
    Latest as LatestRepository,
};


return ParseToObject::execute(array: [
    "repositories" => [
        ParseToObject::execute(array: [
            "case" => CreateCase::class,
            "contract" => CreateContract::class,
            "repository" => CreateRepository::class
        ]),
        ParseToObject::execute(array: [
            "case" => LatestCase::class,
            "contract" => LatestContract::class,
            "repository" => LatestRepository::class
        ]),
    ], "routes" => [
        "src/Modules/MyStaff/Domain/Routes/web.php"
    ]
]);
