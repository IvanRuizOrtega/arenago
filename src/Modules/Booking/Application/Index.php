<?php

namespace Src\Modules\Booking\Application;

use Src\Modules\Booking\Domain\Contracts\Index as IndexContract;

final class Index
{
    private IndexContract $contract;

    public function __construct(
        IndexContract $contract
    ) {
        $this->contract = $contract;
    }

    public function __invoke(
        int $user_id

    ) {
        return $this->contract->index(
            user_id: $user_id,
        );
    }
}
