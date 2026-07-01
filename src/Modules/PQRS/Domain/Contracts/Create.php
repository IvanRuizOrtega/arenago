<?php

namespace Src\Modules\PQRS\Domain\Contracts;

use Src\Modules\PQRS\Domain\ValueObjects\VO;

interface Create
{
    public function create(
        string $type,
        ?int $user_id = null,
        ?int $ranking = null,
        ?string $improvement_idea = null,
        ?string $subject = null,
        ?string $message = null
    ): VO;
}
