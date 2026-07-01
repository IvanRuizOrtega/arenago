<?php

namespace Src\Modules\PQRS\Application;

use Src\Modules\PQRS\Domain\Contracts\Create as CreateContract;
use Src\Modules\PQRS\Domain\ValueObjects\VO;

final class Create
{
    private CreateContract $contract;

    public function __construct(
        CreateContract $contract
    ) {
        $this->contract = $contract;
    }

    public function __invoke(
        string $type,
        ?int $user_id = null,
        ?int $ranking = null,
        ?string $improvement_idea = null,
        ?string $subject = null,
        ?string $message = null
    ): VO {
        return $this->contract->create(
            type: $type,
            user_id: $user_id,
            ranking: $ranking,
            improvement_idea: $improvement_idea,
            subject: $subject,
            message: $message
        );
    }
}
