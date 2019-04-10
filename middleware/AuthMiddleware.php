<?php


namespace App\Middleware;

use App\Components\Session;
use App\Models\User;


class AuthMiddleware implements Middleware
{
    public function handle()
    {
        if (!Session::isset('user')) {
            header('Location: http://'.$_SERVER['HTTP_HOST']. '/login');
            die;
        } else {
            $user = User::find(Session::get('user')['attributes']['id']);
            if (!$user) {
                Session::delete('user');
                $this->handle();
            }
        }
    }
}