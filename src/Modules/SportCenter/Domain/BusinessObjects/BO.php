<?php

namespace Src\Modules\SportCenter\Domain\BusinessObjects;

use Src\Modules\SportCenter\Domain\ValueObjects\VO;
use Src\Modules\SportCenter\Domain\Contracts\Create as CreateContract;

final class BO implements CreateContract
{
    private VO $vo;

    public function __construct(
        VO $vo
    ) {
        $this->vo = $vo;
    }

    public function create(
        string $name,
        string $address,
        string $city,
        float $lat,
        float $long,
        ?array $working_days,
        bool $is_public = FALSE
    ): VO {
        $this->vo->set_name(name: $name);
        $this->vo->set_address(address: $address);
        $this->vo->set_city(city: $city);
        $this->vo->set_lat(lat: $lat);
        $this->vo->set_long(long: $long);
        $this->vo->set_working_days(days: $working_days);
        $this->vo->set_is_public(is_public: $is_public);
        return $this->vo;
    }

    public function get_vo()
    {
        return $this->vo;
    }
}
