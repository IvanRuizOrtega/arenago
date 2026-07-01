<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('authLogout')) {
    function authLogout()
    {
        Auth::logout();
        session()->flush();
        return redirect('/');
    }
}
