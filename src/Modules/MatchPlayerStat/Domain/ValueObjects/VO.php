<?php

namespace Src\Modules\MatchPlayerStat\Domain\ValueObjects;

use Src\Resources\Array\ParseToObject;
use Src\Resources\Constants\Options;

final class VO
{
    private string $name;
    private bool $me;
    private ?int $sport_center_id = null;
    private string $sport_center_name;
    private int $matches_played;
    private int $wins;
    private int $draws;
    private int $losses;
    private int $points;

    public function __construct()
    {
    }

    public function get_name(): string
    {
        return $this->name;
    }

    public function set_name(string $name): void
    {
        $this->name = $name;
    }

    public function get_me(): bool
    {
        return $this->me;
    }

    public function set_me(bool $me): void
    {
        $this->me = $me;
    }
    public function get_sport_center_id(): ?int
    {
        return $this->sport_center_id;
    }

    public function set_sport_center_id(?int $sport_center_id): void
    {
        $this->sport_center_id = $sport_center_id;
    }

    public function get_sport_center_name(): string
    {
        return $this->sport_center_name;
    }

    public function set_sport_center_name(string $sport_center_name): void
    {
        $this->sport_center_name = $sport_center_name;
    }

    public function get_matches_played(): int
    {
        return $this->matches_played;
    }

    public function set_matches_played(int $matches_played): void
    {
        $this->matches_played = $matches_played;
    }

    public function get_wins(): int
    {
        return $this->wins;
    }

    public function set_wins(int $wins): void
    {
        $this->wins = $wins;
    }

    public function get_draws(): int
    {
        return $this->draws;
    }

    public function set_draws(int $draws): void
    {
        $this->draws = $draws;
    }

    public function get_losses(): int
    {
        return $this->losses;
    }

    public function set_losses(int $losses): void
    {
        $this->losses = $losses;
    }

    public function get_points(): int
    {
        return $this->points;
    }

    public function set_points(int $points): void
    {
        $this->points = $points;
    }

    public function simpleObject(): object
    {
        return ParseToObject::execute(array: [
            'name'              => $this->get_name(),
            'sport_center_id'   => $this->get_sport_center_id(),
            'sport_center_name' => $this->get_sport_center_name(),
            'matches_played'    => $this->get_matches_played(),
            'wins'              => $this->get_wins(),
            'draws'             => $this->get_draws(),
            'losses'            => $this->get_losses(),
            'points'            => $this->get_points(),
        ]);
    }
}
