<?php

namespace Src\Modules\User\Infrastructure\Repositories\ORM;

use App\Models\User;
use Src\Modules\User\Domain\Contracts\Index as IndexContract;
use Src\Modules\User\Domain\BusinessObjects\BO;

final class Index
implements IndexContract
{
    private User $model;
    private BO $bo;

    public function __construct(
        User $model,
        BO $bo
    ) {
        $this->model = $model;
        $this->bo = $bo;
    }

    public function index(
        string | NULL $search = NULL
    ) {
        return $this->model->searchBy($search, 'name', 'email', 'username')->with('roles:id,name')->paginate(15)->through(function ($item) {
            $bo = clone $this->bo->index(id: $item->id, name: $item->name, email: $item->email, roles: $item->roles->toArray());
            return $bo;
        });
    }
}
