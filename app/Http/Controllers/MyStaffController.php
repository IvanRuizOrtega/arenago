<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Src\Modules\Booking\Infrastructure\Controllers\Latest as ControllersBookingLatest;
use Src\Modules\Booking\Infrastructure\Controllers\Today as ControllersBookingToday;
use Src\Modules\SportCenter\Infrastructure\Controllers\Played as ControllersSportCenterPlayed;
use Src\Modules\MyStaff\Infrastructure\Controllers\Latest as ControllersLatest;
use Src\Modules\MatchPlayerStat\Infrastructure\Controllers\Index as ControllersMatchPlayerStatIndex;

class MyStaffController extends Controller
{

    public function index(ControllersBookingToday $ctr, Request $rq)
    {
        $user_id = getPropertyAuth(property: 'id');
        $today = $rq->fecha ?? now()->toDateString();
        $response = $ctr->__invoke(user_id: $user_id, day: $today, user: $rq->responsable_id ?? NULL);
        $today_bookings = $response->today_bookings ?? [];
        $completed_matches_count = $response->completed_matches_count ?? 0;
        $total_matches_count = $response->total_matches_count ?? 0;
        $total_revenue = $response->total_revenue ?? 0;
        $users = $response->users ?? [];
        return view('my-staff.index', compact(
            'today_bookings',
            'completed_matches_count',
            'total_matches_count',
            'total_revenue',
            'users'
        ));
    }

    public function myMatchdayHub(
        Request $rq,
        ControllersBookingLatest $ctr_booking_latest,
        ControllersLatest $ctr,
        ControllersMatchPlayerStatIndex $ctr_match_player,
        ControllersSportCenterPlayed $ctr_booking_played
    ) {
        $user_id = getPropertyAuth(property: 'id');
        $year = date('Y');
        return view('my-staff.my-matchday-hub')->with([
            'booking' => $ctr_booking_latest->__invoke(userId: $user_id),
            'ranking' => $ctr->__invoke(userId: $user_id),
            'players_stats' => $ctr_match_player->__invoke(userId: $user_id, sport_center: $rq->sede, current_year: $year),
            'sportCenters' => $ctr_booking_played->__invoke(user_id: $user_id, year: $year)
        ]);
    }
}
