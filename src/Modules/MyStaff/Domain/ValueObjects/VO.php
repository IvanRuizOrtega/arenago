<?php

namespace Src\Modules\MyStaff\Domain\ValueObjects;

use Src\Resources\Array\ParseToObject;

final class VO
{
    private ?int $id = null;
    private int $user_id;
    private int $matches_played = 0;
    private int $wins = 0;
    private int $draws = 0;
    private int $losses = 0;
    private int $points = 0;
    private float $rating = 0.0;

    public function __construct()
    {
    }

    public function set_id(?int $id): void
    {
        $this->id = $id;
    }

    public function get_id(): ?int
    {
        return $this->id;
    }

    public function set_user_id(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function get_user_id(): int
    {
        return $this->user_id;
    }

    public function set_matches_played(int $matches_played): void
    {
        $this->matches_played = $matches_played;
    }

    public function get_matches_played(): int
    {
        return $this->matches_played;
    }

    public function set_wins(int $wins): void
    {
        $this->wins = $wins;
    }

    public function get_wins(): int
    {
        return $this->wins;
    }

    public function set_draws(int $draws): void
    {
        $this->draws = $draws;
    }

    public function get_draws(): int
    {
        return $this->draws;
    }

    public function set_losses(int $losses): void
    {
        $this->losses = $losses;
    }

    public function get_losses(): int
    {
        return $this->losses;
    }

    public function set_points(int $points): void
    {
        $this->points = $points;
    }

    public function get_points(): int
    {
        return $this->points;
    }

    public function set_rating(float $rating): void
    {
        $this->rating = $rating;
    }

    public function get_rating(): float
    {
        return $this->rating;
    }

    public function simpleObject(): object
    {
        return ParseToObject::execute(array: [
            '_id' => $this->get_id(),
            'user_id' => $this->get_user_id() ?? null,
            'matches_played' => $this->get_matches_played(),
            'wins' => $this->get_wins(),
            'draws' => $this->get_draws(),
            'losses' => $this->get_losses(),
            'points' => $this->get_points(),
            'rating' => $this->get_rating(),
        ]);
    }
}
