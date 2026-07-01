<?php

namespace App\Http\Controllers;

use App\Http\Requests\Booking\Close;
use App\Http\Requests\Booking\Create;
use App\Http\Requests\Booking\Team;
use Illuminate\Http\Request;
use Src\Modules\Booking\Infrastructure\Controllers\Create as ControllersCreate;
use Src\Modules\Booking\Infrastructure\Controllers\Index as ControllersIndex;
use Src\Modules\Booking\Infrastructure\Controllers\FindByUser as ControllersFindByUser;
use Src\Modules\Booking\Infrastructure\Controllers\Player as ControllersPlayer;
use Src\Modules\Booking\Infrastructure\Controllers\SavePlayer as ControllersSavePlayer;
use Src\Modules\Booking\Infrastructure\Controllers\Close as ControllersClose;
use Src\Modules\Booking\Infrastructure\Controllers\Update as ControllersUpdate;
use Src\Resources\Constants\Headers;
use Src\Resources\Constants\Messages;
use Src\Resources\Constants\Options;
use Src\Resources\Constants\Routes;

class BookingController extends Controller
{

    public function closeForm($id, ControllersFindByUser $ctr)
    {
        $user_id = getPropertyAuth(property: 'id');
        $response = $ctr->__invoke(id: $id, user_id: $user_id);
        if (!$response->find ?? FALSE) return redirect()->back();
        if ($response->status != array_keys(Options::STATUS)[2]) return redirect()->back();
        return view('booking.close')->with(['booking_id' => $id]);
    }


    public function close($id, Close $rq, ControllersClose $ctr)
    {
        $ctr->__invoke(
            id: $id,
            goals_a: (int) $rq->goals_team_a,
            goals_b: (int) $rq->goals_team_b,
            user_id: getPropertyAuth(property: 'id'),
            rating_service: (int) $rq->service_rating
        );
        return redirect()->route(Routes::MY_MATCHDAY_HUB_INDEX)->with(Messages::SESSION_MESSAGE, [
            "title" => Messages::TITLE_SUCCESS,
            "description" => 'Tu <span class="text-white font-bold">' . (Headers::getKeys()[3] ?? '') . '</span> se cerro correctamente.',
            "alertColor" => Messages::ALERT_SUCCESS_COLOR
        ]);
    }

    public function saveTeam(int $id, Team $rq, ControllersSavePlayer $ctr)
    {
        $ctr->__invoke(
            id: $id,
            user_id: getPropertyAuth(property: 'id'),
            team_a: $rq->team_a_array,
            team_b: $rq->team_b_array
        );
        return redirect()->back()->with(Messages::SESSION_MESSAGE, [
            "title" => Messages::TITLE_SUCCESS,
            "description" => 'Tu <span class="text-white font-bold">' . (Headers::getKeys()[3] ?? '') . '</span> se conformaron correctamente.',
            "alertColor" => Messages::ALERT_SUCCESS_COLOR
        ]);
    }

    public function getAvailablePlayers(int $id, Request $rq, ControllersFindByUser $ctr, ControllersPlayer $ctr_player)
    {
        $user_id = getPropertyAuth(property: 'id') ?: $rq->user_id;
        $response = $ctr->__invoke(id: $id, user_id: $user_id);
        if (!$response->find ?? FALSE) return response()->json([]);
        if ($response->status != array_keys(Options::STATUS)[0]) return response()->json([]);
        $players = $ctr_player->__invoke(search: $rq->search, booking_id: $id, user_id: $user_id);
        return response()->json($players);
    }

    public function team(int $id, ControllersFindByUser $ctr)
    {
        $user_id = getPropertyAuth(property: 'id');
        $response = $ctr->__invoke(id: $id, user_id: $user_id);
        if (!$response->find ?? FALSE) return redirect()->back();
        if ($response->status != array_keys(Options::STATUS)[0]) return redirect()->back();
        return view('booking.team')->with(['booking_id' => $id]);
    }

    public function edit(int $id, Request $request, ControllersUpdate $ctr)
    {
        $action = $request->input('action_type');
        if (!in_array($action, ['yes', 'not'])) return redirect()->back();
        $user_id = getPropertyAuth(property: 'id');
        $ctr->__invoke(id: $id, action: $action, user_id: $user_id);
        return redirect()->back()->with(Messages::SESSION_MESSAGE, [
            "title" => Messages::TITLE_SUCCESS,
            "description" => 'Tu <span class="text-white font-bold">' . (Headers::getKeys()[4] ?? '') . '</span> se actualizo correctamente.',
            "alertColor" => Messages::ALERT_SUCCESS_COLOR
        ]);
    }

    public function index(ControllersIndex $ctr)
    {
        $user_id = getPropertyAuth(property: 'id');
        $data = $ctr->__invoke(user_id: $user_id);
        return view('booking.show')->with([
            'data' => $data,
            'include_options' => TRUE,
        ]);
    }

    public function create(Create $rq, ControllersCreate $ct)
    {
        $ct->__invoke(
            userId: getPropertyAuth(property: 'id'),
            fieldId: $rq->playing_field_id,
            startTime: $rq->start_time,
            durationHours: $rq->duration_hours
        );
        session()->flash(Messages::SESSION_MESSAGE, [
            "title" => Messages::TITLE_SUCCESS,
            "description" => 'Tu <span class="text-white font-bold">Registro</span> se hizo correctamente.',
            "alertColor" => Messages::ALERT_SUCCESS_COLOR
        ]);
        return [];
    }
}
