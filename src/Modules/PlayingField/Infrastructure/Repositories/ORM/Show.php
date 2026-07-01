<?php

namespace Src\Modules\PlayingField\Infrastructure\Repositories\ORM;

use App\Models\PlayingField as PlayingFieldModel;
use Src\Modules\PlayingField\Domain\Contracts\Show as ShowContract;
use Src\Modules\PlayingField\Domain\BusinessObjects\BO;

final class Show
implements ShowContract
{
    private PlayingFieldModel $model;
    private BO $bo;

    public function __construct(
        PlayingFieldModel $model,
        BO $bo,
    ) {
        $this->model = $model;
        $this->bo = $bo;
    }

    public function show(
        int $id,
        int $sport_center_id,
        int | NULL $user_id = NULL,
    ) {
        $mode = $this->model->when($user_id, function ($query, $user_id) {
            return $query->whereHas('sport_center.users', function ($q) use ($user_id) {
                $q->where('users.id', $user_id);
            });
        })->where([
            ["id", $id],
            ["sport_center_id", $sport_center_id]
        ])->firstOrFail();
        $bo = $this->bo->create(
            sport_center_id: $mode->sport_center_id,
            name: $mode->name,
            type: $mode->type,
            price_hour: $mode->price_hour,
            covered: $mode->covered
        );
        $bo->set_id(id: $mode->id);
        return $bo->simpleObject();
    }
}
