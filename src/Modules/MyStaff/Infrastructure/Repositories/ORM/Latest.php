<?php

namespace Src\Modules\MyStaff\Infrastructure\Repositories\ORM;

use App\Models\PlayerRanking as PlayerRankingModel;
use App\Models\PlayingField;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Src\Modules\MyStaff\Domain\BusinessObjects\BO;
use Src\Modules\MyStaff\Domain\Contracts\Latest as LatestContract;
use Src\Modules\MyStaff\Domain\ValueObjects\VO;


final class Latest
implements LatestContract
{
    private BO $bo;
    private PlayerRankingModel $model;

    public function __construct(
        PlayerRankingModel $model,
        BO $bo
    ) {
        $this->model = $model;
        $this->bo = $bo;
    }

    public function latest(
        int $userId
    ): VO | NULL {
        $model = $this->model->where('user_id', $userId)->latest('id')->first();
        if (!$model) return NULL;
        $bo = $this->bo->get_vo();
        $bo->set_id(id: $model->id);
        $bo->set_matches_played(matches_played: $model->matches_played);
        $bo->set_wins(wins: $model->wins);
        $bo->set_draws(draws: $model->draws);
        $bo->set_losses(losses: $model->losses);
        $bo->set_points(points: $model->points);
        $bo->set_rating(rating: $model->rating);
        return $bo;
    }
}
