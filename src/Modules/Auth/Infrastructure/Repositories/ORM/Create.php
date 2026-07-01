<?php

namespace Src\Modules\Auth\Infrastructure\Repositories\ORM;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Src\Modules\Auth\Domain\BusinessObjects\BO;
use Src\Modules\Auth\Domain\Contracts\Create as CreateContract;
use Src\Modules\Auth\Domain\ValueObjects\VO;
use Src\Resources\Constants\Options;

final class Create
implements CreateContract
{
    private BO $bo;
    private User $model;
    private Role $modelRole;

    public function __construct(
        User $model,
        Role $modelRole,
        BO $bo
    ) {
        $this->model = $model;
        $this->modelRole = $modelRole;
        $this->bo = $bo;
    }

    public function create(
        string $id,
        string $name,
        string $email,
        string $token,
        string $pathAvatar,
        string $role
    ): VO {
        $bo = $this->bo->create(
            id: $id,
            name: $name,
            email: $email,
            token: $token,
            pathAvatar: $pathAvatar,
            role: $role
        );
        $model = $this->model->updateOrCreate([
            'google_id' => $bo->get_id(),
        ], [
            'name' => $bo->get_name(),
            'email' => $bo->get_email(),
            'google_token' => $bo->get_token(),
            'google_avatar' => $bo->get_pathAvatar(),
        ]);
        $modelRole = $this->modelRole->firstWhere('key', $role);
        if (!$modelRole) return $bo;
        $model->roles()->syncWithoutDetaching([$modelRole]);
        session([Options::ROLES => $model->roles()->get(['roles.key', 'roles.name'])->toArray()]);
        Auth::login($model);
        return $bo;
    }
}
