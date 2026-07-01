<?php

use Src\Resources\Constants\Options;

if (!function_exists('authChangeRole')) {
    function authChangeRole(string $role)
    {
        session([Options::CURRENT_ROLE => $role]);
    }
}
