<?php

namespace Src\Modules\SportCenter\Infrastructure\Repositories\ORM;

use App\Models\SportCenter as SportCenterModel;
use Src\Modules\SportCenter\Domain\Contracts\Forget as ForgetContract;


final class Forget
implements ForgetContract
{
    private SportCenterModel $model;

    public function __construct(
        SportCenterModel $model,
    ) {
        $this->model = $model;
    }

    public function forget(
        int | NULL $user_id = NULL,
        int $id,
    ): bool {
        return $this->model->when($user_id, function ($query, $user_id) {
            return $query->whereHas('users', function ($q) use ($user_id) {
                $q->where('users.id', $user_id);
            });
        })->where("id", $id)->delete();
    }
}
