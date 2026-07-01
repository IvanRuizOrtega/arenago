<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('isAuth')) {
	function isAuth()
	{
		return Auth::check();
	}
}
