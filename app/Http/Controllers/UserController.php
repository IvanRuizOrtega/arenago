<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\Update;
use Illuminate\Http\Request;
use Src\Modules\User\Infrastructure\Controllers\Index as ControllersIndex;
use Src\Modules\User\Infrastructure\Controllers\Show as ControllersShow;
use Src\Modules\User\Infrastructure\Controllers\Update as ControllersUpdate;
use Src\Modules\SportCenter\Infrastructure\Controllers\All as ControllersAll;
use Src\Resources\Constants\Messages;

class UserController extends Controller
{
    public function index(Request $rq, ControllersIndex $ctr)
    {
        $search = $rq->search ?? NULL;
        $data = $ctr->__invoke(search: $search);
        if ($rq->ajax()) {
            return view('users.partials.table-rows', compact('data'))->render();
        }
        return view('users.index', compact('data'));
    }

    public function show(int $id, ControllersShow $ctr, ControllersAll $ctr_all)
    {
        $response = $ctr->__invoke(id: $id);
        $user = $response->user ?? [];
        $roles = $response->roles ?? [];
        $sport_centers = $ctr_all->__invoke() ?? [];
        $roles_by_user = $response->roles_by_user ?? [];
        $user_centers_ids = $response->user_centers_ids ?? [];
        return view('users.show', compact('user', 'roles', 'sport_centers', 'roles_by_user', 'user_centers_ids'));
    }

    public function update(int $id, Update $rq, ControllersUpdate $ctr)
    {
        $ctr->__invoke(id: $id, roles: $rq->roles, sport_centers: $rq->sport_centers);
        return redirect()->back()->with(Messages::SESSION_MESSAGE, [
            "title" => Messages::TITLE_SUCCESS,
            "description" => 'Cambios <span class="text-white font-bold">guardados</span> correctamente.',
            "alertColor" => Messages::ALERT_SUCCESS_COLOR
        ]);
    }
}
