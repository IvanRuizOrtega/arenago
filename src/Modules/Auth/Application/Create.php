<?php

namespace Src\Modules\Auth\Application;

use Src\Modules\Auth\Domain\Contracts\Create as CreateContract;
use Src\Modules\Auth\Domain\ValueObjects\VO;

final class Create
{
    private CreateContract $contract;

    public function __construct(
        CreateContract $contract
    ) {
        $this->contract = $contract;
    }

    public function __invoke(
        string $id,
        string $name,
        string $email,
        string $token,
        string $pathAvatar,
        string $role
    ): VO {
        return $this->contract->create(
            id: $id,
            name: $name,
            email: $email,
            token: $token,
            pathAvatar: $pathAvatar,
            role: $role
        );
    }
}
