<?php

namespace App\Http\Controllers;

use App\Http\Requests\PQRS\Create;
use Src\Modules\PQRS\Infrastructure\Controllers\Create as ControllersCreate;
use Src\Resources\Constants\Messages;

final class PQRSController extends Controller
{

    public function createForm()
    {
        return view('pqrs.create');
    }

    public function create(Create $rq, ControllersCreate $ctr)
    {
        $ctr->__invoke(
            type: $rq->type,
            user_id: $rq->user()?->id,
            ranking: $rq->ranking,
            improvement_idea: $rq->improvement_idea,
            subject: $rq->subject,
            message: $rq->message
        );
        return redirect()->back()->with(Messages::SESSION_MESSAGE, [
            "title" => Messages::TITLE_SUCCESS,
            "description" => 'Tu <span class="text-white font-bold">Registro</span> se hizo correctamente.',
            "alertColor" => Messages::ALERT_SUCCESS_COLOR
        ]);
    }
}
