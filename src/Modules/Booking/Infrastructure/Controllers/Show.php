<?php

namespace Src\Modules\Booking\Infrastructure\Controllers;

use Src\Modules\Booking\Application\Show as ShowCase;

final class Show
{
    private ShowCase $case;

    public function __construct(
        ShowCase $case
    ) {
        $this->case = $case;
    }

    public function __invoke(
        int $sport_center,
        int $playing_field,
        int | NULL $user_id = NULL
    ) {
        return $this->case->__invoke(
            sport_center: $sport_center,
            playing_field: $playing_field,
            user_id: $user_id,
        );
    }
}
