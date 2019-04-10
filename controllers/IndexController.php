<?php

namespace App\Controllers;

use App\Components\View;
use App\Components\Session;
use App\Models\User;

class IndexController extends Controller
{
    public function index()
    {
        $user = Session::get('user');
        return View::render('home', [
            'user' => $user
        ]);
    }
}