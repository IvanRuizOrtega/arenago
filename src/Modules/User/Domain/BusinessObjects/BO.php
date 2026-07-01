<?php

namespace Src\Modules\User\Domain\BusinessObjects;

use Src\Modules\User\Domain\ValueObjects\VO;

final class BO
{
    private VO $vo;

    public function __construct(VO $vo)
    {
        $this->vo = $vo;
    }

    public function index(
        string $id,
        string $name,
        string $email,
        ?array $roles
    ): VO {
        $this->vo->set_id(id: $id);
        $this->vo->set_name(name: $name);
        $this->vo->set_email(email: $email);
        $this->vo->set_roles(roles: $roles);
        return $this->vo;
    }
}
