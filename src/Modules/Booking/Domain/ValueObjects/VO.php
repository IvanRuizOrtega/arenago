<?php

namespace Src\Modules\Booking\Domain\ValueObjects;

use Src\Resources\Array\ParseToObject;
use Src\Resources\Constants\Options;

final class VO
{
    private ?int $id = null;
    private int $user_id;
    private int $playing_field_id;
    private string $date;
    private string $start_time;
    private string $end_time;
    private string $status;
    private ?string $status_trans;
    private float $total_price;
    private ?string $playing_field_name;
    private ?string $playing_field_type;
    private ?string $sport_center_address;
    private ?string $sport_center_city;
    private ?string $attendant_name;
    private ?string $user_name;
    private ?string $message;
    private ?int $ranking;



    public function __construct()
    {
    }

    public function get_ranking(): ?int
    {
        return $this->ranking;
    }

    public function set_ranking(?int $ranking): void
    {
        $this->ranking = $ranking;
    }

    public function get_message(): ?string
    {
        return $this->message;
    }

    public function set_message(?string $message): void
    {
        $this->message = $message;
    }

    public function get_user_name(): ?string
    {
        return $this->user_name;
    }

    public function set_user_name(?string $user_name): void
    {
        $this->user_name = $user_name;
    }

    public function get_attendant_name(): ?string
    {
        return $this->attendant_name;
    }

    public function set_attendant_name(?string $attendant_name): void
    {
        $this->attendant_name = $attendant_name;
    }

    public function get_sport_center_city(): ?string
    {
        return $this->sport_center_city;
    }

    public function set_sport_center_city(?string $sport_center_city): void
    {
        $this->sport_center_city = $sport_center_city;
    }

    public function get_sport_center_address(): ?string
    {
        return $this->sport_center_address;
    }

    public function set_sport_center_address(?string $sport_center_address): void
    {
        $this->sport_center_address = $sport_center_address;
    }

    public function set_playing_field_type(?string $playing_field_type): void
    {
        $this->playing_field_type = Options::SPORT_CENTERS[$playing_field_type] ?? $playing_field_type;
    }

    public function get_playing_field_type(): ?string
    {
        return $this->playing_field_type;
    }

    public function set_playing_field_name(?string $playing_field_name): void
    {
        $this->playing_field_name = $playing_field_name;
    }

    public function get_playing_field_name(): ?string
    {
        return $this->playing_field_name;
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

    public function set_playing_field_id(int $playing_field_id): void
    {
        $this->playing_field_id = $playing_field_id;
    }

    public function get_playing_field_id(): int
    {
        return $this->playing_field_id;
    }

    public function set_date(string $date): void
    {
        $this->date = $date;
    }

    public function get_date(): string
    {
        return $this->date;
    }

    public function set_start_time(string $start_time): void
    {
        $this->start_time = $start_time;
    }

    public function get_start_time(): string
    {
        return $this->start_time;
    }

    public function set_end_time(string $end_time): void
    {
        $this->end_time = $end_time;
    }

    public function get_end_time(): string
    {
        return $this->end_time;
    }

    public function set_status(string $status): void
    {
        $this->status = $status;
    }

    public function get_status(): string
    {
        return $this->status;
    }

    public function set_status_trans(?string $status): void
    {
        $this->status_trans = Options::STATUS[$status] ?? $status;
    }

    public function get_status_trans(): ?string
    {
        return $this->status_trans;
    }

    public function set_total_price(float $total_price): void
    {
        $this->total_price = $total_price;
    }

    public function get_total_price(): float
    {
        return $this->total_price;
    }

    public function simpleObject(): object
    {
        return ParseToObject::execute(array: [
            '_id' => $this->get_id(),
            'user_id' => $this->get_user_id(),
            'playing_field_id' => $this->get_playing_field_id(),
            'date' => $this->get_date(),
            'start_time' => $this->get_start_time(),
            'end_time' => $this->get_end_time(),
            'status' => $this->get_status(),
            'total_price' => $this->get_total_price(),
        ]);
    }
}
