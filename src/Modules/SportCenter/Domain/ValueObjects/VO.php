<?php

namespace Src\Modules\SportCenter\Domain\ValueObjects;

use Src\Resources\Array\ParseToObject;

class VO
{
    private ?int $id = NULL;
    private string $name;
    private string $address;
    private string $city;
    private float $lat;
    private float $long;
    private array $working_days = [];
    private bool $is_public = false;

    public function __construct()
    {
    }

    public function set_id(
        ?int $id
    ): void {
        $this->id = $id;
    }

    public function get_id(): int | NULL
    {
        return $this->id;
    }

    public function set_name(
        string $name
    ): void {
        $this->name = $name;
    }

    public function get_name(): string
    {
        return  $this->name;
    }

    public function set_address(
        string $address
    ): void {
        $this->address = $address;
    }

    public function get_address(): string
    {
        return  $this->address;
    }

    public function set_city(
        string $city
    ): void {
        $this->city = $city;
    }

    public function get_city(): string
    {
        return  $this->city;
    }

    public function set_lat(
        float $lat
    ): void {
        $this->lat = $lat;
    }

    public function get_lat(): float
    {
        return $this->lat;
    }

    public function set_long(
        float $long
    ): void {
        $this->long = $long;
    }

    public function get_long(): float
    {
        return  $this->long;
    }

    public function set_working_days(?array $days): void
    {
        $this->working_days = $days ?? [];
    }
    public function get_working_days(): array
    {
        return $this->working_days;
    }

    public function set_is_public(bool $is_public): void
    {
        $this->is_public = $is_public;
    }
    public function get_is_public(): bool
    {
        return $this->is_public;
    }

    public function get_status_open(): bool
    {
        // 1. Si es público, siempre está abierto
        if ($this->get_is_public()) {
            return true;
        }

        // 1. Obtener el número del día actual (1 para Lunes, 7 para Domingo)
        $today = (string) now()->format('N');
        $schedule = $this->get_working_days();

        // 2. Si el día de hoy no está definido en el horario, está cerrado
        if (!isset($schedule[$today])) {
            return false;
        }

        $opening_time = $schedule[$today]['open'];
        $closing_time = $schedule[$today]['close'];
        $current = now()->format('H:i:s');

        // 3. Lógica de comparación de horas
        if ($opening_time < $closing_time) {
            return $current >= $opening_time && $current <= $closing_time;
        }
        return $current >= $opening_time || $current <= $closing_time;
    }

    public function simpleObject(): object
    {
        return ParseToObject::execute(array: [
            '_id' => $this->get_id(),
            'name' => $this->get_name(),
            'address' => $this->get_address(),
            'city' => $this->get_city(),
            'lat' => $this->get_lat(),
            'long' => $this->get_long(),
            'working_days' => $this->get_working_days(),
            'is_public' => $this->get_is_public(),
            'is_open' => $this->get_status_open(),
        ]);
    }
}
