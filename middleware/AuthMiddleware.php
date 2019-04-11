<?php


namespace App\Middleware;

use App\Components\Session;
use App\Models\User;


class AuthMiddleware implements Middleware
{
    public function handle()
    {
        // если пользователя нет в системе - перенаправить на страницу входа
        if (!Session::isset('user')) {
            header('Location: http://'.$_SERVER['HTTP_HOST']. '/login');
            die;
        } else {
            // если есть - проверить, есть ли такой пользователь в БД, если он был удалён - значит удаляем его так же из системы
            $user = User::find(Session::get('user')['attributes']['id']);
            if (!$user) {
                Session::delete('user');
                $this->handle();
            }
        }
    }
}