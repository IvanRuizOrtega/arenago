<?php

use Src\Resources\Array\ParseToObject;

use Src\Modules\Auth\Application\{
	Create as Createcase,
};
use Src\Modules\Auth\Domain\Contracts\{
	Create as CreateContract,
};
use Src\Modules\Auth\Infrastructure\Repositories\ORM\{
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
		"src/Modules/Auth/Domain/Routes/web.php"
	]
]);
