<?php


namespace App\Controllers;

use App\Models\User;
use App\Components\View;
use App\Components\Validator;
use App\Components\Session;

class LoginController extends Controller
{
    public function index()
    {
        return View::render('login');
    }

    public function loginuser()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $_POST;
            if (!empty($data)) {
                $rules = [
                    'email' => ['required'],
                    'password' => ['required'],
                ];
                $messages = [
                    'email.required' => 'Поле Email обезательное',
                    'password.required' => 'Поле Пароль обезательное',
                ];
                $validator = Validator::validate($data, $rules, $messages);
                $users = User::where(['email' => $data['email']])::get();
                if (empty($users)) {
                    Session::setFlash('error', [['Пользователя с таким email нет в системе']]);
                    header('Location: http://'.$_SERVER['HTTP_HOST']. "/login");
                } else {
                    $user = array_shift($users);
                    if (!password_verify($data['password'], $user->password)) {
                        Session::setFlash('error', [['Неверный пароль']]);
                        header('Location: http://'.$_SERVER['HTTP_HOST']. "/login");
                    } else {
                        Session::set('user', $user);
                        Session::setFlash('success', [['Вы успешно войшли в систему']]);
                        header('Location: http://'.$_SERVER['HTTP_HOST']. "/");
                    }
                }
            }

        } else {
            throw new \Exception('Error: method is not allowed');
        }
    }

    public function logout()
    {
        Session::delete('user');
        Session::setFlash('success', [['Вы успешно вышли из системы']]);
        header('Location: http://'.$_SERVER['HTTP_HOST']. "/login");
    }

}