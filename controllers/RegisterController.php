<?php


namespace App\Controllers;

use App\Components\View;

class RegisterController extends Controller
{
    public function index()
    {
        return View::render('registration');
    }

    public function signup()
    {
        echo '<pre>';
        print_r($_POST);
        echo '<pre>';
        die;
    }
}