<?php

namespace Src\Modules\PQRS\Infrastructure\Controllers;

use Src\Modules\PQRS\Application\Create as CreateCase;
use Src\Modules\PQRS\Domain\ValueObjects\VO;

final class Create
{
    private CreateCase $case;

    public function __construct(
        CreateCase $case
    ) {
        $this->case = $case;
    }

    public function __invoke(
        string $type,
        ?int $user_id = null,
        ?int $ranking = null,
        ?string $improvement_idea = null,
        ?string $subject = null,
        ?string $message = null
    ): VO {
        return $this->case->__invoke(
            type: $type,
            user_id: $user_id,
            ranking: $ranking,
            improvement_idea: $improvement_idea,
            subject: $subject,
            message: $message
        );
    }
}
