<?php


namespace App\Controllers;

use App\Models\User;
use App\Components\View;

class LoginController extends Controller
{
    public function index()
    {
        return View::render('login');
    }

    public function loginuser()
    {

    }

}