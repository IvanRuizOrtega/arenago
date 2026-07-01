<?php

namespace Src\Modules\Auth\Infrastructure\Controllers;

use Src\Modules\Auth\Application\Create as CreateCase;
use Src\Modules\Auth\Domain\ValueObjects\VO;

final class Create
{
    private CreateCase $case;

    public function __construct(
        CreateCase $case
    ) {
        $this->case = $case;
    }

    public function __invoke(
        string $id,
        string $name,
        string $email,
        string $token,
        string $pathAvatar,
        string $role
    ): VO {
        return $this->case->__invoke(
            id: $id,
            name: $name,
            email: $email,
            token: $token,
            pathAvatar: $pathAvatar,
            role: $role
        );
    }
}
