<?php

namespace Src\Modules\SportCenter\Infrastructure\Repositories\ORM;

use App\Models\SportCenter as SportCenterModel;
use Src\Modules\SportCenter\Domain\Contracts\Show as ShowContract;
use Src\Modules\PlayingField\Domain\BusinessObjects\BO;

final class Show
implements ShowContract
{
    private SportCenterModel $model;
    private BO $bo;

    public function __construct(
        SportCenterModel $model,
        BO $bo,
    ) {
        $this->model = $model;
        $this->bo = $bo;
    }

    public function show(
        int $id,
        int | NULL $user_id = NULL,
    ) {
        $item = $this->model->with('playingFields')->when($user_id, function ($query, $user_id) {
            return $query->whereHas('users', function ($q) use ($user_id) {
                $q->where('users.id', $user_id);
            });
        })->where("id", $id)->firstOrFail();
        $days = $item->working_days;
        return $item->playingFields->map(function ($field) use ($days) {
            $_item = $this->bo->create(
                sport_center_id: (int) $field->sport_center_id,
                name: $field->name,
                type: $field->type,
                price_hour: (float) $field->price_hour,
                covered: (bool) $field->covered,
            );
            $_item->set_working_days(days: $days);
            $_item->set_id(id: $field->id);
            return $_item->simpleObject();
        });
    }
}
