<?php


if (!function_exists('authCheckRole')) {
    function authCheckRole(...$roles)
    {
        if (empty($roles)) return true;
        return in_array(authCurrentRole(), $roles);
    }
}
