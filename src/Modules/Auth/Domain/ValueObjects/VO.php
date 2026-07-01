<?php

namespace Src\Modules\Auth\Domain\ValueObjects;

use Src\Resources\Array\ParseToObject;

final class VO
{
    private string $id;
    private string $name;
    private string $email;
    private string $token;
    private string $pathAvatar;
    private string $role;

    public function __construct()
    {
    }

    public function set_id(string $id): void
    {
        $this->id = $id;
    }

    public function get_id(): string
    {
        return $this->id;
    }

    public function set_name(string $name): void
    {
        $this->name = $name;
    }

    public function get_name(): string
    {
        return $this->name;
    }

    public function set_email(string $email): void
    {
        $this->email = $email;
    }

    public function get_email(): string
    {
        return $this->email;
    }

    public function set_token(string $token): void
    {
        $this->token = $token;
    }

    public function get_token(): string
    {
        return $this->token;
    }

    public function set_pathAvatar(string $pathAvatar): void
    {
        $this->pathAvatar = $pathAvatar;
    }

    public function get_pathAvatar(): string
    {
        return $this->pathAvatar;
    }

    public function set_role(string $role): void
    {
        $this->role = $role;
    }

    public function get_role(): string
    {
        return $this->role;
    }

    public function simpleObject(): object
    {
        return ParseToObject::execute(array: [
            'id' => $this->get_id(),
            'name' => $this->get_name(),
            'email' => $this->get_email(),
            'token' => $this->get_token(),
            'pathAvatar' => $this->get_pathAvatar(),
            'role' => $this->get_role(),
        ]);
    }
}
