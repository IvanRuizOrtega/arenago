<?php

use Src\Resources\Constants\Options;

if (!function_exists('authRole')) {
    function authRole()
    {
        return session(Options::ROLES, []);
    }
}
