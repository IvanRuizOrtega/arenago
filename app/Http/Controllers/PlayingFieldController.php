<?php

namespace App\Http\Controllers;

use App\Http\Requests\Booking\AvaliableHours;
use Src\Modules\PlayingField\Infrastructure\Controllers\AvailableHours as AvailableHoursController;

class PlayingFieldController extends Controller
{
    public function avaliableHours(int $id, AvaliableHours $rq, AvailableHoursController $ctr)
    {
        return $ctr->__invoke(id: $id, date: $rq->date, open: $rq->open, close: $rq->close);
    }
}
