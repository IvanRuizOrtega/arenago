<?php

namespace Src\Modules\PQRS\Infrastructure\Repositories\ORM;

use App\Models\PQRS as PQRSModel;
use Src\Modules\PQRS\Domain\BusinessObjects\BO;
use Src\Modules\PQRS\Domain\Contracts\Create as CreateContract;
use Src\Modules\PQRS\Domain\ValueObjects\VO;


final class Create
implements CreateContract
{
    private BO $bo;
    private PQRSModel $model;

    public function __construct(
        PQRSModel $model,
        BO $bo
    ) {
        $this->model = $model;
        $this->bo = $bo;
    }

    public function create(
        string $type,
        ?int $user_id = null,
        ?int $ranking = null,
        ?string $improvement_idea = null,
        ?string $subject = null,
        ?string $message = null
    ): VO {
        $bo = $this->bo->create(
            type: $type,
            user_id: $user_id,
            ranking: $ranking,
            improvement_idea: $improvement_idea,
            subject: $subject,
            message: $message
        );
        $model = $this->model->create([
            'type' => $bo->get_type(),
            'user_id' => $bo->get_user_id(),
            'ranking' => $bo->get_ranking(),
            'improvement_idea' => $bo->get_improvement_idea(),
            'subject' => $bo->get_subject(),
            'message' => $bo->get_message()
        ]);
        $bo->set_id(id: $model->id);
        return $bo;
    }
}
