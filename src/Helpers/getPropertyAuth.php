<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('getPropertyAuth')) {
    function getPropertyAuth(string $property)
    {
        return Auth::user()->$property ?? "";
    }
}
