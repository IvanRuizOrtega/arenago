<?php

namespace Src\Modules\SportCenter\Infrastructure\Repositories\ORM;

use App\Models\SportCenter as SportCenterModel;
use Src\Modules\SportCenter\Domain\Contracts\Update as UpdateContract;


final class Update
implements UpdateContract
{
    private SportCenterModel $model;

    public function __construct(
        SportCenterModel $model,
    ) {
        $this->model = $model;
    }

    public function update(
        int $id,
        string $name,
        string $address,
        string $city,
        float $lat,
        float $long,
        ?array $working_days,
        bool $is_public = FALSE
    ): bool {
        return $this->model->where([
            ['id', $id],
        ])->update([
            'name' => $name,
            'address' => $address,
            'city' => $city,
            'lat' => $lat,
            'long' => $long,
            'working_days' => $working_days,
            'is_public' => $is_public
        ]);
    }
}
