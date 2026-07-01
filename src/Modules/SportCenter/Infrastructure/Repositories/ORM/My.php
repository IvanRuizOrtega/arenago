<?php

namespace Src\Modules\SportCenter\Infrastructure\Repositories\ORM;

use App\Models\SportCenter as SportCenterModel;
use Src\Modules\SportCenter\Domain\BusinessObjects\BO;
use Src\Modules\SportCenter\Domain\Contracts\My as MyContract;


final class My
implements MyContract
{
    private BO $bo;
    private SportCenterModel $model;

    public function __construct(
        SportCenterModel $model,
        BO $bo
    ) {
        $this->model = $model;
        $this->bo = $bo;
    }

    public function my(?int $user_id)
    {
        return $this->model->when($user_id, function ($query, $user_id) {
            return $query->whereHas('users', function ($q) use ($user_id) {
                $q->where('users.id', $user_id);
            });
        })->orderBy('id', 'DESC')->paginate(10)->through(function ($item) {
            $_item = $this->bo->create(
                name: $item->name,
                address: $item->address,
                city: $item->city,
                lat: (float) $item->lat,
                long: (float) $item->long,
                is_public: (bool) $item->is_public,
                working_days: $item->working_days ?? []
            );
            $_item->set_id(id: (int)$item->id);
            return $_item->simpleObject();
        });
    }
}
