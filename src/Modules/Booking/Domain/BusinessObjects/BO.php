<?php

namespace Src\Modules\Booking\Domain\BusinessObjects;

use Src\Modules\Booking\Domain\ValueObjects\VO;
use Src\Modules\Booking\Domain\Contracts\Create as CreateContract;

final class BO implements CreateContract
{
    private VO $vo;

    public function __construct(
        VO $vo
    ) {
        $this->vo = $vo;
    }

    public function create(
        int $userId,
        int $fieldId,
        string $startTime,
        int $durationHours = 1
    ): VO {
        $this->vo->set_user_id(user_id: $userId);
        $this->vo->set_playing_field_id(playing_field_id: $fieldId);
        $this->vo->set_start_time(start_time: $startTime);
        return $this->vo;
    }
}
