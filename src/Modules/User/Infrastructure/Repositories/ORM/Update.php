<?php

namespace Src\Modules\User\Infrastructure\Repositories\ORM;

use App\Models\User;
use Src\Modules\User\Domain\Contracts\Update as UpdateContract;


final class Update
implements UpdateContract
{
    private User $model;

    public function __construct(
        User $model,
    ) {
        $this->model = $model;
    }

    public function update(
        int $id,
        ?array $roles = [],
        ?array $sport_centers = []
    ) {
        $user = $this->model->findOrFail($id);
        $user->roles()->sync($roles ?? []);
        $user->sport_centers()->sync($sport_centers ?? []);
    }
}
