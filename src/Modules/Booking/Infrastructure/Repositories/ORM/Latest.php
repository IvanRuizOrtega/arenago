<?php

namespace Src\Modules\Booking\Infrastructure\Repositories\ORM;

use App\Models\Booking as BookingModel;
use Src\Modules\Booking\Domain\BusinessObjects\BO;
use Src\Modules\Booking\Domain\Contracts\Latest as LatestContract;
use Src\Modules\Booking\Domain\ValueObjects\VO;
use Src\Resources\Constants\Options;

final class Latest
implements LatestContract
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

    public function latest(
        int $userId
    ): VO | NULL {
        $status_keys = array_keys(Options::STATUS);
        $model = $this->model->with(
            'playing_field',
            'playing_field.sport_center'
        )->where('user_id', $userId)->whereIn('status', [$status_keys[0], $status_keys[1], $status_keys[2]])->latest('id')->first();
        if (!$model) return NULL;
        $bo = $this->bo->create(userId: $userId, fieldId: $model->playing_field_id, startTime: $model->start_time, durationHours: 0);
        $bo->set_total_price(total_price: $model->total_price);
        $bo->set_id(id: $model->id);
        $bo->set_end_time(end_time: $model->end_time);
        $bo->set_date(date: $model->date);
        $bo->set_status(status: $model->status);
        $bo->set_sport_center_city(sport_center_city: $model->playing_field->sport_center->city);
        $bo->set_sport_center_address(sport_center_address: $model->playing_field->sport_center->address);
        $bo->set_playing_field_name(playing_field_name: $model->playing_field->name);
        $bo->set_playing_field_type(playing_field_type: $model->playing_field->type);
        return $bo;
    }
}
