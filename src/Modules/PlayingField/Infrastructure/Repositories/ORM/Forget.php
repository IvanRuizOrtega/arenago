<?php

namespace Src\Modules\PlayingField\Infrastructure\Repositories\ORM;

use App\Models\PlayingField as PlayingFieldModel;
use Src\Modules\PlayingField\Domain\Contracts\Forget as ForgetContract;


final class Forget
implements ForgetContract
{
    private PlayingFieldModel $model;

    public function __construct(
        PlayingFieldModel $model,
    ) {
        $this->model = $model;
    }

    public function forget(
        int $id,
        int $sport_center_id,
        int | NULL $user_id = NULL
    ) {
        $this->model->when($user_id, function ($query, $user_id) {
            return $query->whereHas('sport_center.users', function ($q) use ($user_id) {
                $q->where('users.id', $user_id);
            });
        })->where([
            ["id", $id],
            ["sport_center_id", $sport_center_id]
        ])->delete();
    }
}
