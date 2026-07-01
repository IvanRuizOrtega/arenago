<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Src\Modules\SportCenter\Infrastructure\Controllers\Index as ControllersIndex;
use Src\Resources\Instances\SportCenter;

final class HomeController extends Controller
{
    public function index(Request $rq, ControllersIndex $ctr)
    {
        $response = SportCenter::getSportCenter(rq: $rq, ctr: $ctr, paginate: 4);
        return view('welcome')->with([
            'data' => $response,
        ]);
    }
}
