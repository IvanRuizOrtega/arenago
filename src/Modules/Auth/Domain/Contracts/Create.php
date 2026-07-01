<?php

namespace Src\Modules\Auth\Domain\Contracts;

use Src\Modules\Auth\Domain\ValueObjects\VO;

interface Create
{
    public function create(
        string $id,
        string $name,
        string $email,
        string $token,
        string $pathAvatar,
        string $role
    ): VO;
}
