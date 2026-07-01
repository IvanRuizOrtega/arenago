<?php

namespace Src\Modules\Booking\Infrastructure\Repositories\ORM;

use App\Models\Booking as BookingModel;
use App\Models\PlayingField;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Src\Modules\Booking\Domain\BusinessObjects\BO;
use Src\Modules\Booking\Domain\Contracts\Create as CreateContract;
use Src\Modules\Booking\Domain\ValueObjects\VO;


final class Create
implements CreateContract
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

    public function create(
        int $userId,
        int $fieldId,
        string $startTime,
        int $durationHours = 1
    ): VO {
        $start = Carbon::parse($startTime);
        $end = (clone $start)->addHours($durationHours);
        // 2. VALIDACIÓN DE TIEMPO REGLAMENTARIO
        /* if ($start->isPast()) { */
        /*     throw ValidationException::withMessages(['start_time' => 'No puedes reservar en fechas u horas pasadas.']); */
        /* } */

        return DB::transaction(function () use ($userId, $fieldId, $start, $end, $durationHours) {

            $field = PlayingField::where('id', $fieldId)
                ->lockForUpdate()
                ->firstOrFail();

            $bo = $this->bo->create(userId: $userId, fieldId: $fieldId, startTime: $start->format('H:i:s'), durationHours: $durationHours);
            $bo->set_total_price(total_price: $field->price_hour * $durationHours);
            $bo->set_date(date: $start->toDateString());
            $bo->set_end_time(end_time: $end->format('H:i:s'));

            // VERIFICAR DISPONIBILIDAD REAL (¿Se cruza con otra reserva activa?)
            $isOccupied = $this->model->where('playing_field_id', $fieldId)
                ->whereIn('status', ['pending', 'confirmed'])
                ->where(function ($query) use ($bo) {
                    $query->where(function ($q) use ($bo) {
                        $q->where('date', $bo->get_date())->where('start_time', $bo->get_start_time())->where('end_time', $bo->get_end_time());
                    });
                })->exists();

            if ($isOccupied) {
                throw ValidationException::withMessages([
                    'availability' => 'Lo sentimos, esta cancha ya ha sido reservada en el horario seleccionado por otro usuario.'
                ]);
            }

            $this->model->create([
                'user_id' => $bo->get_user_id(),
                'playing_field_id' => $bo->get_playing_field_id(),
                'start_time' => $bo->get_start_time(),
                'end_time' => $bo->get_end_time(),
                'status' => 'confirmed',
                'total_price' => $bo->get_total_price(),
                'date' => $bo->get_date()
            ]);
            return $bo;
        });
    }
}
