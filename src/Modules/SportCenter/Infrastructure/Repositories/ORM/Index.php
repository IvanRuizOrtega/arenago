<?php

namespace Src\Modules\SportCenter\Infrastructure\Repositories\ORM;

use App\Models\SportCenter as SportCenterModel;
use Src\Modules\SportCenter\Domain\BusinessObjects\BO;
use Src\Modules\SportCenter\Domain\Contracts\Index as IndexContract;


final class Index
implements IndexContract
{
    private SportCenterModel $model;
    private BO $bo;

    public function __construct(
        SportCenterModel $model,
        BO $bo
    ) {
        $this->model = $model;
        $this->bo = $bo;
    }

    public function index(
        string $lat,
        string $long,
        int | NULL $user_id = NULL,
        string | NUll $search = NULL,
        int $paginate = 10,
        ...$attributes
    ) {
        return $this->model->nearby($lat, $long, 15)->paginate($paginate)->through(function ($item) {
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
