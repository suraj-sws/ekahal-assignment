<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function isLogin()
    {
        return session()->has('id') && is_numeric(session()->get('id')) && session()->has('isLogIn');
    }
}
