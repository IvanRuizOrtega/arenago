<?php

namespace Src\Modules\Booking\Infrastructure\Repositories\ORM;

use App\Models\Booking as BookingModel;
use Src\Modules\Booking\Domain\BusinessObjects\BO;
use Src\Modules\Booking\Domain\Contracts\Index as IndexContract;


final class Index
implements IndexContract
{
    private BO $bo;
    private BookingModel $model;

    public function __construct(
        BookingModel $model,
        BO $bo
    ) {
        $this->model = $model;
        $this->bo = $bo;
    }

    public function Index(
        int $user_id
    ) {
        return $this->model->when($user_id, function ($query, $user_id) {
            return $query->whereHas('playing_field.sport_center.users', function ($q) use ($user_id) {
                $q->where('users.id', $user_id);
            });
        })
            ->with(
                'requested:id,name',
                /* 'playing_field:id,sport_center_id,name,type', */
                /* 'playing_field.sport_center:id,name', */
                'attendant:id,name'
            )->orderByDesc('id')
            ->paginate(10)->through(function ($item) {
                $bo = clone $this->bo->create(
                    userId: $item->user_id,
                    fieldId: $item->playing_field_id,
                    startTime: $item->start_time,
                    durationHours: 0
                );
                $bo->set_id(id: $item->id);
                $bo->set_date(date: $item->date);
                $bo->set_status(status: $item->status);
                $bo->set_status_trans(status: $item->status);
                $bo->set_end_time(end_time: $item->end_time);
                $bo->set_total_price(total_price: $item->total_price);
                $bo->set_user_name(user_name: $item->requested->name ?? "");
                $bo->set_attendant_name(attendant_name: $item->attendant->name ?? "");
                $bo->set_message(message: $item->message ?? "");
                $bo->set_ranking(ranking: $item->ranking ?? 5);
                return $bo;
            });
    }
}
