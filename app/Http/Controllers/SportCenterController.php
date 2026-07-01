<?php

namespace App\Http\Controllers;

use App\Http\Requests\SportCenter\Create;
use App\Http\Requests\SportCenter\Update;
use App\Http\Requests\PlayingField\Create as PlayingFieldCreate;
use App\Http\Requests\PlayingField\Update as PlayingFieldUpdate;
use Illuminate\Http\Request;
use Src\Modules\SportCenter\Infrastructure\Controllers\Index as ControllersIndex;
use Src\Modules\SportCenter\Infrastructure\Controllers\Create as ControllersCreate;
use Src\Modules\SportCenter\Infrastructure\Controllers\My as ControllersMy;
use Src\Modules\SportCenter\Infrastructure\Controllers\FindOne as ControllersFindOne;
use Src\Modules\SportCenter\Infrastructure\Controllers\Forget as ControllersForget;
use Src\Modules\SportCenter\Infrastructure\Controllers\Update as ControllersUpdate;
use Src\Modules\SportCenter\Infrastructure\Controllers\Show as ControllersShow;
use Src\Modules\PlayingField\Infrastructure\Controllers\Create as ControllersPlayingFieldCreate;
use Src\Modules\PlayingField\Infrastructure\Controllers\Show as ControllersPlayingFieldShow;
use Src\Modules\PlayingField\Infrastructure\Controllers\Update as ControllersUPlayingFieldpdate;
use Src\Modules\PlayingField\Infrastructure\Controllers\Forget as ControllersPlayingFieldForget;
use Src\Modules\Booking\Infrastructure\Controllers\Show as ControllersBookingShow;
use Src\Resources\Constants\Headers;
use Src\Resources\Constants\Messages;
use Src\Resources\Constants\Roles;
use Src\Resources\Instances\SportCenter;

final class SportCenterController extends Controller
{
    public function index(Request $rq, ControllersIndex $ctr)
    {
        $response = SportCenter::getSportCenter(rq: $rq, ctr: $ctr);
        return view('sport-center.index')->with([
            'data' => $response,
        ]);
    }

    public function createForm()
    {
        return view('sport-center.create');
    }

    public function create(Create $request, ControllersCreate $ctr)
    {
        $sport_center = $ctr->__invoke(
            name: $request->name,
            address: $request->address,
            city: $request->city,
            lat: $request->lat,
            long: $request->long,
            working_days: $request->working_days,
            is_public: $request->working_days ? FALSE : (in_array(authCurrentRole(), [Roles::ADMIN]) ? TRUE : FALSE)
        );
        // le asignamos al usuario en session
        if (!$sport_center->get_is_public()) $request->user()->sport_centers()->syncWithoutDetaching([$sport_center->get_id()]);
        return redirect()->back()->with(Messages::SESSION_MESSAGE, [
            "title" => Messages::TITLE_SUCCESS,
            "description" => 'Tu <span class="text-white font-bold">' . (Headers::getKeys()[1] ?? '') . '</span> se hizo correctamente.',
            "alertColor" => Messages::ALERT_SUCCESS_COLOR
        ]);
    }

    public function my(ControllersMy $ctr)
    {
        $user_id = in_array(authCurrentRole(), [Roles::OWNER, Roles::COLLABORATOR]) ? getPropertyAuth(property: 'id') : NULL;
        $data = $ctr->__invoke(user_id: $user_id);
        return view('sport-center.my')->with([
            'data' => $data
        ]);
    }

    public function editForm(int $id, ControllersFindOne $ctr)
    {
        $user_id = in_array(authCurrentRole(), [Roles::OWNER]) ? getPropertyAuth(property: 'id') : NULL;
        $item = $ctr->__invoke(user_id: $user_id, id: $id);
        return view('sport-center.create')->with(['item' => $item]);
    }

    public function edit(int $id, Update $request, ControllersUpdate $ctr)
    {
        $ctr->__invoke(
            id: $id,
            name: $request->name,
            address: $request->address,
            city: $request->city,
            lat: $request->lat,
            long: $request->long,
            working_days: $request->working_days,
            is_public: $request->working_days ? FALSE : (in_array(authCurrentRole(), [Roles::ADMIN]) ? TRUE : FALSE)
        );
        return redirect()->back()->with(Messages::SESSION_MESSAGE, [
            "title" => Messages::TITLE_SUCCESS,
            "description" => 'Tu <span class="text-white font-bold">' . (Headers::getKeys()[1] ?? '') . '</span> se actualizo correctamente.',
            "alertColor" => Messages::ALERT_SUCCESS_COLOR
        ]);
    }

    public function forget(int $id, ControllersForget $ctr)
    {
        $user_id = in_array(authCurrentRole(), [Roles::OWNER]) ? getPropertyAuth(property: 'id') : NULL;
        $ctr->__invoke(user_id: $user_id, id: $id);
        return redirect()->back()->with(Messages::SESSION_MESSAGE, [
            "title" => Messages::TITLE_SUCCESS,
            "description" => 'Tu <span class="text-white font-bold">' . (Headers::getKeys()[1] ?? '') . '</span> se elimino correctamente.',
            "alertColor" => Messages::ALERT_SUCCESS_COLOR
        ]);
    }

    public function show(int $id, ControllersShow $ctr)
    {
        $response = $ctr->__invoke(id: $id);
        return view('sport-center.show')->with(['data' => $response]);
    }

    public function myShow(int $id, ControllersShow $ctr)
    {
        $user_id = in_array(authCurrentRole(), [Roles::OWNER, Roles::COLLABORATOR]) ? getPropertyAuth(property: 'id') : NULL;
        $data = $ctr->__invoke(id: $id, user_id: $user_id);
        return view('playing-field.my')->with([
            'data' => $data,
            '_id' => $id
        ]);
    }

    public function myPlayingFieldShow(int $id, int $playing_field_id, ControllersBookingShow $ctr)
    {
        $user_id = in_array(authCurrentRole(), [Roles::OWNER, Roles::COLLABORATOR]) ? getPropertyAuth(property: 'id') : NULL;
        $data = $ctr->__invoke(sport_center: $id, playing_field: $playing_field_id, user_id: $user_id);
        return view('booking.show')->with([
            'data' => $data,
            'sport_center' => $id,
            'include_options' => FALSE,
        ]);
    }

    public function myCreateForm(int $id, ControllersFindOne $ctr)
    {
        $user_id = in_array(authCurrentRole(), [Roles::OWNER, Roles::COLLABORATOR]) ? getPropertyAuth(property: 'id') : NULL;
        $ctr->__invoke(id: $id, user_id: $user_id);
        return view('playing-field.create')->with(['_id' => $id]);
    }


    public function myCreate(int $id, PlayingFieldCreate $rq, ControllersFindOne $ctr_find_one, ControllersPlayingFieldCreate $ctr)
    {
        $user_id = in_array(authCurrentRole(), [Roles::OWNER, Roles::COLLABORATOR]) ? getPropertyAuth(property: 'id') : NULL;
        $ctr_find_one->__invoke(id: $id, user_id: $user_id);
        $ctr->__invoke(sport_center_id: $id, name: $rq->name, type: $rq->type, price_hour: $rq->price_hour, covered: (bool) $rq->covered);
        return redirect()->back()->with(Messages::SESSION_MESSAGE, [
            "title" => Messages::TITLE_SUCCESS,
            "description" => 'Tu <span class="text-white font-bold">' . (Headers::getKeys()[1] ?? '') . '</span> se hizo correctamente.',
            "alertColor" => Messages::ALERT_SUCCESS_COLOR
        ]);
    }

    public function myEditForm(int $id, int $playing_field_id, ControllersPlayingFieldShow $ctr)
    {
        $user_id = in_array(authCurrentRole(), [Roles::OWNER, Roles::COLLABORATOR]) ? getPropertyAuth(property: 'id') : NULL;
        $item = $ctr->__invoke(id: $playing_field_id, sport_center_id: $id, user_id: $user_id);
        return view('playing-field.create')->with([
            'item' => $item,
            '_id' => $id
        ]);
    }

    public function myUpdate(int $id, int $playing_field_id, PlayingFieldUpdate $rq, ControllersUPlayingFieldpdate $ctr)
    {
        $ctr->__invoke(sport_center_id: $id, id: $playing_field_id, name: $rq->name, type: $rq->type, price_hour: $rq->price_hour, covered: (bool) $rq->covered);
        return redirect()->back()->with(Messages::SESSION_MESSAGE, [
            "title" => Messages::TITLE_SUCCESS,
            "description" => 'Tu <span class="text-white font-bold">' . (Headers::getKeys()[1] ?? '') . '</span> se actualizo correctamente.',
            "alertColor" => Messages::ALERT_SUCCESS_COLOR
        ]);
    }

    public function myForget(int $id, int $playing_field_id, ControllersPlayingFieldForget $ctr)
    {
        $user_id = in_array(authCurrentRole(), [Roles::OWNER, Roles::COLLABORATOR]) ? getPropertyAuth(property: 'id') : NULL;
        $ctr->__invoke(id: $playing_field_id, sport_center_id: $id, user_id: $user_id);
        return redirect()->back()->with(Messages::SESSION_MESSAGE, [
            "title" => Messages::TITLE_SUCCESS,
            "description" => 'Tu <span class="text-white font-bold">' . (Headers::getKeys()[1] ?? '') . '</span> se elimino correctamente.',
            "alertColor" => Messages::ALERT_SUCCESS_COLOR
        ]);
    }
}
