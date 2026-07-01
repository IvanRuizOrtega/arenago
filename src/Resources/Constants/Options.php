<?php

namespace Src\Resources\Constants;

final class Options
{
    public const LOGIN = 'INGRESA';
    public const LOGOUT = 'SALIR';
    public const BADGET = 'PRESUPUESTOS';
    public const TRANSACTIONS = 'TRANSACCIONES';
    public const CATEGORY = 'CATEGORIAS';
    public const NEW = 'NUEVO';
    public const EDIT = 'GUARDAR EDICION';
    public const CURRENT_ROLE = 'temp_role';
    public const ROLES = 'temp_roles';

    public const PQRS = [
        'petition' => 'Petición',
        'complaint' => 'Queja',
        'claim' => 'Reclamo',
        'suggestion' => 'Sugerencia'
    ];
    public const PQRS_IMPROVEMENT_IDEA = 'improvement_idea';
    public const PQRS_RANKING = 'ranking';

    public const SPORT_CENTERS = [
        'fl-11' => 'Fútbol',
        'fl-8' => 'Fútbol 8',
        'fl-7' => 'Fútbol 7',
        'fl-5' => 'Fútbol 5',
        /* 'pd' => 'Pádel', */
        /* 'ts' => 'Tenis', */
        /* 'bl' => 'Basketball', */
        /* 'vl' => 'Voleibol', */
        /* 'ue' => 'Ultimate' */
    ];

    public const CITIES = [
        'Bogotá' => 'Bogotá',
        'Medellín' => 'Medellín',
    ];

    ## DAYS
    public const DAYS = [
        1 => 'Lun', 2 => 'Mar', 3 => 'Mié', 4 => 'Jue',
        5 => 'Vie', 6 => 'Sáb', 7 => 'Dom'
    ];

    ## Yes or no
    public const YES_OR_NOT = [
        true => 'Si',
        false => 'No'
    ];

    public const STATUS = [
        'confirmed' => 'Reservada',
        'pending' => 'Pendiente',
        'in_progress' => 'Confirmada',
        'finished' => 'Finalizada',
        'cancelled' => 'Cancelada'
    ];
}
