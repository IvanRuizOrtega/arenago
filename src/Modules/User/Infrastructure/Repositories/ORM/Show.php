<?php

namespace Src\Modules\User\Infrastructure\Repositories\ORM;

use App\Models\Role;
use App\Models\User;
use Src\Modules\User\Domain\Contracts\Show as ShowContract;
use Src\Resources\Array\ParseToObject;


final class Show
implements ShowContract
{
    private User $model;
    private Role $model_role;

    public function __construct(
        User $model,
        Role $model_role,
    ) {
        $this->model = $model;
        $this->model_role = $model_role;
    }

    public function show(
        int $id
    ): object {
        $user = $this->model->findOrFail($id)->load('sport_centers:id', 'roles:id');
        $roles = $this->model_role->select('id', 'name')->whereNot('key', 'LIKE', '%admin%')->get();

        return ParseToObject::execute(array: [
            'user' => $user,
            'roles' => $roles,
            'user_centers_ids' => $user->sport_centers->pluck('id')->toArray(),
            'roles_by_user' => $user->roles->pluck('id')->toArray()
        ]);
    }
}
