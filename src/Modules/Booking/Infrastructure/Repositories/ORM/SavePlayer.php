<?php

namespace Src\Modules\Booking\Infrastructure\Repositories\ORM;

use App\Models\Booking as BookingModel;
use Src\Modules\Booking\Domain\Contracts\SavePlayer as SavePlayerContract;
use Src\Resources\Constants\Options;

final class SavePlayer
implements SavePlayerContract
{
    private BookingModel $model;

    public function __construct(
        BookingModel $model,
    ) {
        $this->model = $model;
    }

    public function save_player(
        int $id,
        int $user_id,
        array $team_a,
        array $team_b
    ) {
        $sync_data = [];
        $this->make_teams(sync_data: $sync_data, users: $team_a);
        $this->make_teams(sync_data: $sync_data, users: $team_b, team: 2);
        $model = $this->model->where([
            ['id', $id],
            ['user_id', $user_id],
            ['status', array_keys(Options::STATUS)[0]]
        ])->first();
        if ($model && $sync_data) $model->players()->sync($sync_data);
    }

    private function make_teams(&$sync_data, array $users, int $team = 1)
    {
        foreach ($users as $key) {
            $sync_data[$key] = [
                'team_id' => $team,
                'goals' => 0,
                'assists' => 0
            ];
        }
    }
}
