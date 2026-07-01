<?php

namespace Src\Modules\Booking\Infrastructure\Repositories\ORM;

use App\Models\Booking as BookingModel;
use App\Models\User;
use Src\Modules\Booking\Domain\BusinessObjects\BO;
use Src\Modules\Booking\Domain\Contracts\Today as TodayContract;
use Src\Resources\Constants\Options;

final class Today
implements TodayContract
{
    private BO $bo;
    private BookingModel $model;
    private User $model_user;

    public function __construct(
        BookingModel $model,
        User $model_user,
        BO $bo
    ) {
        $this->model = $model;
        $this->model_user = $model_user;
        $this->bo = $bo;
    }

    public function today(
        int $user_id,
        string $day,
        ?string $user
    ) {
        $model = $this->model->whereHas('playing_field.sport_center.users', function ($query) use ($user_id) {
            $query->where('users.id', $user_id);
        })->when($user, function ($query, $user) {
            $query->whereHas('attendant', function ($q) use ($user) {
                $q->where('username', $user);
            });
        })->whereDate('date', $day)
            ->with('playing_field.sport_center', 'attendant:id,name')
            ->orderBy('start_time', 'asc')
            ->get();

        $users = $this->model_user->whereHas('sport_centers', function ($query) use ($model) {
            $query->whereIn('sport_center_id', $model->pluck('playing_field.sport_center.id')->toArray());
        })->get()->select('username', 'name')->toArray();

        $status_keys = array_keys(Options::STATUS);

        // 2. Métrica: Total de canchas/partidos finalizados hoy
        $completed_matches_count = $model->where('status', $status_keys[3])->count();

        // 3. Métrica: Total de canchas asignadas hoy en total
        $total_matches_count = $model->count();

        // 4. Métrica: Dinero recaudado hoy (Sumatoria de los partidos completados o en juego)
        $total_revenue = $model->whereIn('status', [$status_keys[3], $status_keys[2]])->sum('total_price');

        // 5. Pasamos las reservas del dia de hoy
        $total_bookings = $model->map(function ($item) {
            $bo = clone $this->bo->create(
                userId: $item->user_id,
                fieldId: $item->playing_field_id,
                startTime: $item->start_time,
                durationHours: 0
            );
            $bo->set_date(date: $item->date);
            $bo->set_status_trans(status: $item->status);
            $bo->set_end_time(end_time: $item->end_time);
            $bo->set_total_price(total_price: $item->total_price);
            $bo->set_user_name(user_name: $item->requested->name ?? "");
            $bo->set_attendant_name(attendant_name: $item->attendant->name ?? "");
            $bo->set_playing_field_id(playing_field_id: $item->playing_field->id);
            $bo->set_playing_field_name(playing_field_name: $item->playing_field->name);
            $bo->set_sport_center_address(
                sport_center_address: $item->playing_field->sport_center->name . " - " . $item->playing_field->sport_center->address
            );
            $bo->set_message(message: $item->message ?? "");
            $bo->set_ranking(ranking: $item->ranking ?? 5);
            return $bo;
        });

        return (object) [
            'today_bookings' => $total_bookings,
            'completed_matches_count' => $completed_matches_count,
            'total_matches_count' => $total_matches_count,
            'total_revenue' => $total_revenue,
            'users' => $users
        ];
    }
}
