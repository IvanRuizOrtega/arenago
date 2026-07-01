<?php

use Src\Resources\Constants\Options;

if (!function_exists('authCurrentRole')) {
    function authCurrentRole()
    {
        return session(Options::CURRENT_ROLE, NULL);
    }
}
