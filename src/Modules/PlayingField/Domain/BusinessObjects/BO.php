<?php

namespace Src\Modules\PlayingField\Domain\BusinessObjects;

use Src\Modules\PlayingField\Domain\ValueObjects\VO;
use Src\Modules\PlayingField\Domain\Contracts\Create as CreateContract;

final class BO implements CreateContract
{
    private VO $vo;

    public function __construct(
        VO $vo
    ) {
        $this->vo = $vo;
    }

    public function create(
        ?int $sport_center_id,
        string $name,
        string $type,
        float $price_hour,
        bool $covered = FALSE
    ): VO {
        $this->vo->set_sport_center_id(sport_center_id: $sport_center_id);
        $this->vo->set_name(name: $name);
        $this->vo->set_type(type: $type);
        $this->vo->set_price_hour(price_hour: $price_hour);
        $this->vo->set_covered(covered: $covered);
        return $this->vo;
    }
}
