<?php

namespace Src\Modules\MatchPlayerStat\Domain\BusinessObjects;

use Src\Modules\MatchPlayerStat\Domain\ValueObjects\VO;

final class BO
{
    private VO $vo;

    public function __construct(
        VO $vo
    ) {
        $this->vo = $vo;
    }

    public function set_item(
        string $name,
        bool $me,
        ?int $sport_center_id = null,
        string $sport_center_name,
        int $matches_played,
        int $wins,
        int $draws,
        int $losses,
        int $points,
    ): VO {
        $this->vo->set_name(name: $name);
        $this->vo->set_me(me: $me);
        $this->vo->set_sport_center_id(sport_center_id: $sport_center_id);
        $this->vo->set_sport_center_name(sport_center_name: $sport_center_name);
        $this->vo->set_matches_played(matches_played: $matches_played);
        $this->vo->set_wins(wins: $wins);
        $this->vo->set_draws(draws: $draws);
        $this->vo->set_losses(losses: $losses);
        $this->vo->set_points(points: $points);
        return $this->vo;
    }
}
