<?php

namespace Src\Modules\PlayingField\Infrastructure\Repositories\ORM;

use App\Models\PlayingField as PlayingFieldModel;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Src\Modules\PlayingField\Domain\Contracts\AvailableHours as AvailableHoursContract;
use Src\Resources\Constants\Options;

final class AvailableHours
implements AvailableHoursContract
{
    private PlayingFieldModel $model;

    public function __construct(
        PlayingFieldModel $model,

    ) {
        $this->model = $model;
    }

    public function available_hours(
        ?int $id,
        string $date,
        string $open,
        string $close,
    ) {
        $status_keys = array_keys(Options::STATUS);
        $item = $this->model->with(['sport_center', 'bookings' => function ($query) use ($date, $status_keys) {
            $query->whereDate('date', $date)->whereIn('status', [$status_keys[0], $status_keys[1], $status_keys[2]]);
        }])->where("id", $id)->firstOrFail();

        $carbonDate = Carbon::parse($date);
        $dayOfWeek = $carbonDate->dayOfWeekIso;
        $workingDays = $item->sport_center->working_days ?? [];
        $dayConfig = $workingDays[$dayOfWeek] ?? NULL;

        if (!$dayConfig || !isset($dayConfig['open']) || !isset($dayConfig['close'])) {
            return ['hours' => []];
        }

        $startSchedule = Carbon::parse($date . ' ' . $dayConfig['open']);
        $endSchedule = Carbon::parse($date . ' ' . $dayConfig['close']);

        // Si el cierre es menor o igual a la apertura por error de data, prevenimos fallos
        if ($endSchedule->lte($startSchedule)) {
            return ['hours' => []];
        }
        // Generamos bloques de 1 hora hasta el penúltimo bloque disponible
        $period = CarbonPeriod::since($startSchedule)
            ->hours(1)
            ->until($endSchedule->subHour());

        // 5. Mapeo y detección de colisiones con los bookings existentes
        foreach ($period as $slot) {
            $slotStart = $slot;
            $slotEnd = (clone $slot)->addHour();

            $isOccupied = false;

            foreach ($item->bookings as $booking) {
                // Se asume que $booking->start_time y end_time guardan h:i:s
                $bookingStart = Carbon::parse($booking->date . ' ' . $booking->start_time);
                $bookingEnd = Carbon::parse($booking->date . ' ' . $booking->end_time);

                if ($slotStart->lt($bookingEnd) && $slotEnd->gt($bookingStart)) {
                    $isOccupied = true;
                    break;
                }
            }

            if (!$isOccupied) {
                $availableSlots[] = [
                    'value' => $slotStart->format('H:i:s'),
                    'label' => $slotStart->format('H:i') . ' - ' . $slotEnd->format('H:i')
                ];
            }
        }

        return [
            'hours' => $availableSlots
        ];
    }
}
