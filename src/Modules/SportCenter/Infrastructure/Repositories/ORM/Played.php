<?php

namespace Src\Modules\SportCenter\Infrastructure\Repositories\ORM;

use App\Models\SportCenter as SportCenterModel;
use Src\Modules\SportCenter\Domain\Contracts\Played as PlayedContract;
use Src\Modules\SportCenter\Domain\BusinessObjects\BO;
use Src\Resources\Constants\Options;

final class Played
implements PlayedContract
{
    private BO $bo;
    private SportCenterModel $model;

    public function __construct(
        SportCenterModel $model,
        BO $bo
    ) {
        $this->model = $model;
        $this->bo = $bo;
    }

    public function played(
        ?int $user_id,
        ?string $year
    ) {
        return $this->model->whereHas('playingFields.bookings', function ($query) use ($user_id, $year) {
            $query->where('status', array_keys(Options::STATUS)[3])
                ->whereYear('date', $year)
                ->whereHas('players', function ($player_query) use ($user_id) {
                    $player_query->where('users.id', $user_id);
                });
        })
            ->select('id', 'name')->get()->map(function ($item) {
                $bo = clone $this->bo->get_vo();
                $bo->set_id(id: $item->id);
                $bo->set_name(name: $item->name);
                return $bo;
            });
    }
}
