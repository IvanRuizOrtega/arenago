<?php

namespace Src\Resources\Constants;


final class Headers
{
    public const LINKS = [
        'Sedes' => [
            'path' => Routes::SPORT_CENTER_INDEX,
            'roles' => [Roles::CLIENT]
        ],
        'Mis sedes' => [
            'path' => Routes::MY_SPORT_CENTER_INDEX,
            'roles' => [Roles::OWNER, Roles::ADMIN]
        ],
        'Mi staff' => [
            'path' => Routes::MY_STAFF_INDEX,
            'roles' => [Roles::OWNER]
        ],
        'Matchday Hub' => [
            'path' => Routes::MY_MATCHDAY_HUB_INDEX,
            'roles' => [Roles::CLIENT]
        ],
        'Centro de Mando (Staff)' => [
            'path' => Routes::BOOKING_INDEX,
            'roles' => [Roles::COLLABORATOR]
        ],
        'PQRS' => [
            'path' => Routes::PQRS_CREATE_FORM,
            'roles' => []
        ],
        'Usuarios' => [
            'path' => Routes::USERS_INDEX,
            'roles' => [Roles::ADMIN]
        ],
    ];

    public static function getKeys(): array
    {
        return array_keys(self::LINKS);
    }
}
