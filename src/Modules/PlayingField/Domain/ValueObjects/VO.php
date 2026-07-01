<?php

namespace Src\Modules\PlayingField\Domain\ValueObjects;

use InvalidArgumentException;
use Src\Resources\Array\ParseToObject;
use Src\Resources\Constants\Options;
use Src\Modules\SportCenter\Domain\ValueObjects\VO as VOSportCenter;

final class VO extends VOSportCenter
{
    private ?int $id = NULL;
    private string $name;
    private string $type;
    private float $price_hour;
    private bool $covered;
    private ?int $sport_center_id = NULL;

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

    public function set_sport_center_id(
        ?int $sport_center_id
    ): void {
        $this->sport_center_id = $sport_center_id;
    }

    public function get_sport_center_id(): int | NULL
    {
        return $this->sport_center_id;
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

    public function set_type(
        string $type
    ): void {
        $this->type = $type;
    }

    public function get_type(): string
    {
        return  $this->type;
    }

    public function set_price_hour(
        float $price_hour
    ): void {
        $this->price_hour = $price_hour;
    }

    public function get_price_hour(): float
    {
        return  $this->price_hour;
    }

    public function set_covered(
        float $covered
    ): void {
        $this->covered = $covered;
    }

    public function get_covered(): float
    {
        return  $this->covered;
    }

    private function validate(): void
    {
        // Validar que el tipo de cancha sea uno de los definidos en tus constantes
        if (!array_key_exists($this->type, Options::SPORT_CENTERS)) {
            throw new InvalidArgumentException("El tipo de cancha '{$this->type}' no es válido.");
        }

        // Validar que el precio por hora sea coherente
        if ($this->get_price_hour() < 0) {
            throw new InvalidArgumentException("El precio por hora no puede ser negativo.");
        }
    }

    public function simpleObject(): object
    {
        return ParseToObject::execute(array: [
            '_id' => $this->get_id(),
            'name' => $this->get_name(),
            'type' => Options::SPORT_CENTERS[$this->get_type()] ?? $this->get_type(),
            'price_hour' => $this->get_price_hour(),
            'covered' => $this->get_covered(),
            'working_days' => $this->get_working_days(),
            /* 'is_open' => TRUE, */
            /* 'address' => '', */
            /* 'city' => 'parent', */
            /* 'is_public' => FALSE */
        ]);
    }
}
