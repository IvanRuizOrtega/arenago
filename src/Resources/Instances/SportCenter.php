<?php

namespace Src\Resources\Instances;

use Stevebauman\Location\Facades\Location;
use Illuminate\Http\Request;
use Src\Modules\SportCenter\Infrastructure\Controllers\Index as ControllersIndex;

final class SportCenter
{
    public static function getSportCenter(Request $rq, ControllersIndex $ctr, int $paginate = 10)
    {
        $location = Location::get($rq->ip());
        $lat = $location ? $location->latitude : "4.60970000";
        $long = $location ? $location->longitude : "-74.08170000";
        $response = $ctr->__invoke($lat, $long, $rq->user()?->id, $rq->get('search'), $paginate, 'name', 'address');
        $response->appends($rq->except('page'));
        return $response;
    }
}
