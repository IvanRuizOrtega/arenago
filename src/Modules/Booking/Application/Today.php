<?php

namespace Src\Modules\Booking\Application;

use Src\Modules\Booking\Domain\Contracts\Today as TodayContract;

final class Today
{
    private TodayContract $contract;

    public function __construct(
        TodayContract $contract
    ) {
        $this->contract = $contract;
    }

    public function __invoke(int $user_id, string $day, ?string $user)
    {
        return $this->contract->today(user_id: $user_id, day: $day, user: $user);
    }
}
