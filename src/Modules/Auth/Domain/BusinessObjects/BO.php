<?php

namespace Src\Modules\Auth\Domain\BusinessObjects;

use Src\Modules\Auth\Domain\ValueObjects\VO;
use Src\Modules\Auth\Domain\Contracts\Create as CreateContract;

final class BO implements CreateContract
{
    private VO $vo;

    public function __construct(VO $vo)
    {
        $this->vo = $vo;
    }

    public function create(
        string $id,
        string $name,
        string $email,
        string $token,
        string $pathAvatar,
        string $role
    ): VO {
        $this->vo->set_id($id);
        $this->vo->set_name($name);
        $this->vo->set_email($email);
        $this->vo->set_token($token);
        $this->vo->set_pathAvatar($pathAvatar);
        $this->vo->set_role($role);

        return $this->vo;
    }
}
