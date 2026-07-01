<?php

namespace Src\Modules\Booking\Infrastructure\Repositories\ORM;

use App\Models\Booking as BookingModel;
use Illuminate\Support\Facades\DB;
use Src\Modules\Booking\Domain\Contracts\Close as CloseContract;
use Src\Resources\Constants\Options;

final class Close
implements CloseContract
{
    private BookingModel $model;

    public function __construct(
        BookingModel $model,
    ) {
        $this->model = $model;
    }

    public function close(
        int $id,
        int $goals_a,
        int $goals_b,
        int $user_id,
        int $rating_service
    ) {
        $team_results = [];
        if ($goals_a > $goals_b) {
            $team_results[1] = 'W'; // Equipo A gana
            $team_results[2] = 'L'; // Equipo B pierde
        } elseif ($goals_b > $goals_a) {
            $team_results[1] = 'L'; // Equipo A pierde
            $team_results[2] = 'W'; // Equipo B gana
        } else {
            $team_results[1] = 'D'; // Empate
            $team_results[2] = 'D'; // Empate
        }
        DB::transaction(function () use ($id, $user_id, $team_results, $rating_service) {
            $booking = $this->model->where([['id', $id], ['user_id', $user_id]])->with('players')->first();
            $players = $booking->players()->select('users.id')->get();
            foreach ($players as $player) {
                $team_id = (int) $player->pivot->team_id;
                if (!isset($team_results[$team_id])) {
                    continue;
                }
                $result = $team_results[$team_id];
                $is_win = $result === 'W' ? 1 : 0;
                $is_draw = $result === 'D' ? 1 : 0;
                $is_loss = $result === 'L' ? 1 : 0;
                $points_earned = $is_win ? 3 : ($is_draw ? 1 : 0);
                $ranking = $player->ranking()->firstOrNew();
                $ranking->matches_played += 1;
                $ranking->wins += $is_win;
                $ranking->draws += $is_draw;
                $ranking->losses += $is_loss;
                $ranking->points += $points_earned;
                $max_points = $ranking->matches_played * 3;
                $ranking->rating = round(($ranking->points / $max_points) * 5, 2);
                $ranking->save();
            }
            $booking->update([
                'status' => array_keys(Options::STATUS)[3],
                'ranking' => $rating_service
            ]);
        });
    }
}
