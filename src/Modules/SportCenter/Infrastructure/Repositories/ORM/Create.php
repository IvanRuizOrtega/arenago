<?php

namespace Src\Modules\SportCenter\Infrastructure\Repositories\ORM;

use App\Models\SportCenter as SportCenterModel;
use Src\Modules\SportCenter\Domain\BusinessObjects\BO;
use Src\Modules\SportCenter\Domain\Contracts\Create as CreateContract;
use Src\Modules\SportCenter\Domain\ValueObjects\VO;


final class Create
implements CreateContract
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

    public function create(
        string $name,
        string $address,
        string $city,
        float $lat,
        float $long,
        ?array $working_days,
        bool $is_public = FALSE
    ): VO {
        $bo = $this->bo->create(
            name: $name,
            address: $address,
            city: $city,
            lat: $lat,
            long: $long,
            working_days: $working_days,
            is_public: $is_public
        );
        $model = $this->model->create([
            'name' => $bo->get_name(),
            'address' => $bo->get_address(),
            'city' => $bo->get_city(),
            'lat' => $bo->get_lat(),
            'long' => $bo->get_long(),
            'working_days' => $bo->get_working_days(),
            'is_public' => $bo->get_is_public()
        ]);
        $bo->set_id(id: $model->id);
        return $bo;
    }
}
