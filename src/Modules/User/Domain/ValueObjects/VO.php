<?php

namespace Src\Modules\User\Domain\ValueObjects;

final class VO
{
    private string $id;
    private string $name;
    private string $email;
    private string $roles;

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

    public function set_roles(?array $roles): void
    {
        $this->roles =  implode(', ', array_column($roles, 'name'));;
    }

    public function get_roles(): string
    {
        return $this->roles;
    }
}
