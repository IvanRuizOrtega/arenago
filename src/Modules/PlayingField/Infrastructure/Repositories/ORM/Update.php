<?php

namespace Src\Modules\PlayingField\Infrastructure\Repositories\ORM;

use App\Models\PlayingField as PlayingFieldModel;
use Src\Modules\PlayingField\Domain\BusinessObjects\BO;
use Src\Modules\PlayingField\Domain\Contracts\Update as UpdateContract;
use Src\Modules\PlayingField\Domain\ValueObjects\VO;


final class Update
implements UpdateContract
{
    private BO $bo;
    private PlayingFieldModel $model;

    public function __construct(
        PlayingFieldModel $model,
        BO $bo
    ) {
        $this->model = $model;
        $this->bo = $bo;
    }

    public function update(
        int $id,
        int $sport_center_id,
        string $name,
        string $type,
        float $price_hour,
        bool $covered = FALSE
    ): VO {
        $bo = $this->bo->create(sport_center_id: $sport_center_id, name: $name, type: $type, price_hour: $price_hour, covered: $covered);
        $bo->set_id(id: $id);
        $this->model->where([
            ["id", $bo->get_id()],
            ["sport_center_id", $bo->get_sport_center_id()]
        ])->update([
            'name' => $bo->get_name(),
            'sport_center_id' => $bo->get_sport_center_id(),
            'type' => $bo->get_type(),
            'price_hour' => $bo->get_price_hour(),
            'covered' => $bo->get_covered(),
        ]);
        return $bo;
    }
}
