<?php

use Src\Resources\Array\ParseToObject;

use Src\Modules\PQRS\Application\{
    Create as Createcase,
};
use Src\Modules\PQRS\Domain\Contracts\{
    Create as CreateContract,
};
use Src\Modules\PQRS\Infrastructure\Repositories\ORM\{
    Create as CreateRepository,
};


return ParseToObject::execute(array: [
    "repositories" => [
        ParseToObject::execute(array: [
            "case" => CreateCase::class,
            "contract" => CreateContract::class,
            "repository" => CreateRepository::class
        ]),
    ], "routes" => [
        "src/Modules/PQRS/Domain/Routes/web.php"
    ]
]);
