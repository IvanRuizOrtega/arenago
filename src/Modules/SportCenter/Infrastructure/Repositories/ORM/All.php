<?php

namespace Src\Modules\SportCenter\Infrastructure\Repositories\ORM;

use App\Models\SportCenter as SportCenterModel;
use Src\Modules\SportCenter\Domain\BusinessObjects\BO;
use Src\Modules\SportCenter\Domain\Contracts\All as AllContract;


final class All
implements AllContract
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

    public function all()
    {
        $result = [];
        $this->model->select('id', 'name', 'city', 'address', 'is_public')->chunk(100, function ($items) use (&$result) {
            foreach ($items as $item) {
                $bo = clone $this->bo->get_vo();
                $bo->set_id(id: $item->id);
                $bo->set_name(name: $item->name);
                $bo->set_city(city: $item->city);
                $bo->set_address(address: $item->address);
                $bo->set_is_public(is_public: $item->is_public);
                $result[] = $bo;
            }
            return $result;
        });
        return $result;
    }
}
