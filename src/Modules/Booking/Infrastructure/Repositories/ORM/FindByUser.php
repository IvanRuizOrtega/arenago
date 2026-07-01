<?php

namespace Src\Modules\Booking\Infrastructure\Repositories\ORM;

use App\Models\Booking as BookingModel;
use Src\Modules\Booking\Domain\Contracts\FindByUser as FindByUserContract;
use Src\Resources\Array\ParseToObject;
use Src\Resources\Constants\Options;

final class FindByUser
implements FindByUserContract
{
    private BookingModel $model;

    public function __construct(
        BookingModel $model,
    ) {
        $this->model = $model;
    }

    public function find_by_user(
        int $id,
        int $user_id
    ) {
        $status_keys = array_keys(Options::STATUS);
        $model = $this->model->where([
            ['id', $id],
            ['user_id', $user_id],
        ])->whereIn('status', [$status_keys[0], $status_keys[2]])->first();
        return ParseToObject::execute(array: [
            'find' => (bool)$model,
            'status' => (bool) $model ? $model->status : ''
        ]);
    }
}
