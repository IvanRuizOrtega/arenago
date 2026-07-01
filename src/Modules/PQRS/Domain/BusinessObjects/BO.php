<?php

namespace Src\Modules\PQRS\Domain\BusinessObjects;

use Src\Modules\PQRS\Domain\ValueObjects\VO;
use Src\Modules\PQRS\Domain\Contracts\Create as CreateContract;

final class BO implements CreateContract
{
    private VO $vo;

    public function __construct(
        VO $vo
    ) {
        $this->vo = $vo;
    }

    public function create(
        string $type,
        ?int $user_id = null,
        ?int $ranking = null,
        ?string $improvement_idea = null,
        ?string $subject = null,
        ?string $message = null
    ): VO {
        $this->vo->set_type(type: $type);
        $this->vo->set_user_id(user_id: $user_id);
        $this->vo->set_improvement_idea(improvement_idea: $improvement_idea);
        $this->vo->set_ranking(ranking: $ranking);
        $this->vo->set_subject(subject: $subject);
        $this->vo->set_message(message: $message);
        return $this->vo;
    }
}
