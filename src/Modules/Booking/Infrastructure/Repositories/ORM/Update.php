<?php

namespace Src\Modules\Booking\Infrastructure\Repositories\ORM;

use App\Models\Booking as BookingModel;
use Src\Modules\Booking\Domain\Contracts\Update as UpdateContract;
use Src\Resources\Constants\Options;

final class Update
implements UpdateContract
{
    private BookingModel $model;

    public function __construct(
        BookingModel $model,
    ) {
        $this->model = $model;
    }

    public function update(
        int $id,
        string $action,
        int $user_id
    ) {
        $keys = array_keys(Options::STATUS);
        $status = [
            'yes' => $keys[2],
            'not' => $keys[4]
        ];
        $message = $action == 'not' ? 'Cancelada por el equipo de staff' : NULL;
        return $this->model->when($user_id, function ($query, $user_id) {
            return $query->whereHas('playing_field.sport_center.users', function ($q) use ($user_id) {
                $q->where('users.id', $user_id);
            });
        })->where('id', $id)->update([
            'status' => $status[$action],
            'attended_by' => $user_id,
            'message' => $message
        ]);
    }
}
