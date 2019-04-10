<?php


namespace App\Middleware;

use App\Components\Session;


class AuthMiddleware implements Middleware
{
    public function handle()
    {
        if (!Session::isset('user')) {
            header('Location: http://'.$_SERVER['HTTP_HOST']. '/login');
        }
    }
}