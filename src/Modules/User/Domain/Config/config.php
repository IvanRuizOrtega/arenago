<?php

use Src\Resources\Array\ParseToObject;

use Src\Modules\User\Application\{
    Friend as Friendcase,
    Index as Indexcase,
    Show as Showcase,
    Update as Updatecase,
};
use Src\Modules\User\Domain\Contracts\{
    Friend as FriendContract,
    Index as IndexContract,
    Show as ShowContract,
    Update as UpdateContract,
};
use Src\Modules\User\Infrastructure\Repositories\ORM\{
    Friend as FriendRepository,
    Index as IndexRepository,
    Show as ShowRepository,
    Update as UpdateRepository,
};


return ParseToObject::execute(array: [
    "repositories" => [
        ParseToObject::execute(array: [
            "case" => FriendCase::class,
            "contract" => FriendContract::class,
            "repository" => FriendRepository::class
        ]),
        ParseToObject::execute(array: [
            "case" => IndexCase::class,
            "contract" => IndexContract::class,
            "repository" => IndexRepository::class
        ]),
        ParseToObject::execute(array: [
            "case" => ShowCase::class,
            "contract" => ShowContract::class,
            "repository" => ShowRepository::class
        ]),
        ParseToObject::execute(array: [
            "case" => UpdateCase::class,
            "contract" => UpdateContract::class,
            "repository" => UpdateRepository::class
        ]),
    ], "routes" => [
        "src/Modules/User/Domain/Routes/web.php"
    ]
]);
