<?php

namespace Src\Modules\MatchPlayerStat\Infrastructure\Repositories\ORM;

use App\Models\MatchPlayerStat as MatchPlayerStatModel;
use Src\Modules\MatchPlayerStat\Domain\BusinessObjects\BO;
use Src\Modules\MatchPlayerStat\Domain\Contracts\Index as IndexContract;
use Src\Resources\Constants\Options;

final class Index
implements IndexContract
{
    private BO $bo;
    private MatchPlayerStatModel $model;

    public function __construct(
        MatchPlayerStatModel $model,
        BO $bo
    ) {
        $this->model = $model;
        $this->bo = $bo;
    }

    public function index(
        int $userId,
        string | NULL $current_year = NULL,
        int | NULL $sport_center = NULL
    ): array | NULL {
        $my_match_ids = $this->model->where('user_id', $userId)->when($current_year, function ($query, $current_year) {
            return $query->whereHas('match', function ($q) use ($current_year) {
                $q->whereYear('date', $current_year);
            });
        })->pluck('booking_id');
        $players_stats_query = $this->model->with([
            'player:id,name',
            'player.ranking:id,user_id,matches_played,wins,draws,losses,points',
            'match:id,playing_field_id,date',
            'match.playing_field:id,sport_center_id,name', // sport_center_id es vital para el sub-eager loading
            'match.playing_field.sport_center:id,name'
        ])->whereIn('booking_id', $my_match_ids) // Solo partidos en los que estuviste
            ->when($current_year, function ($query, $current_year) {
                return $query->whereHas('match', function ($q) use ($current_year) {
                    $q->whereYear('date', $current_year)->whereIn('status', [array_keys(Options::STATUS)[3]]);
                });
            })->when($sport_center, function ($query, $sport_center) {
                return $query->whereHas('match.playing_field', function ($q) use ($sport_center) {
                    $q->where('sport_center_id', $sport_center);
                });
            });

        return $players_stats_query->get()->unique('user_id')
            ->sortByDesc(function ($item) {
                return (int) ($item->player->ranking->points ?? 0);
            })->map(function ($item) use ($userId) {
                $bo = clone $this->bo->set_item(
                    name: $item->player->name ?? 'Anónimo',
                    me: ($item->player->id ?? null) === $userId,
                    sport_center_id: $item->match->playing_field->sport_center->id ?? null,
                    sport_center_name: $item->match->playing_field->sport_center->name ?? 'Sede sin nombre',
                    matches_played: $item->player->ranking->matches_played ?? 0,
                    wins: $item->player->ranking->wins ?? 0,
                    draws: $item->player->ranking->draws ?? 0,
                    losses: $item->player->ranking->losses ?? 0,
                    points: $item->player->ranking->points ?? 0,
                );
                return $bo;
            })->values()
            ->all();
    }
}
