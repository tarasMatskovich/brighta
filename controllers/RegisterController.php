<?php


namespace App\Controllers;

use App\Components\View;
use App\Components\Validator;
use App\Components\Session;

class RegisterController extends Controller
{
    public function index()
    {
        return View::render('registration');
    }

    public function signup()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $_POST;
            if (!empty($data)) {
                $rules = [
                    'email' => ['required'],
                    'name' => ['required'],
                    'surname' => ['required'],
                    'phone' => ['number', 'required'],
                    'password' => ['required', 'password_confirm'],
                ];
                $messages = [
                    'email.required' => 'Поле Email обезательное',
                    'name.required' => 'Поле Имя обезательное',
                    'surname.required' => 'Поле Фамилия обезательное',
                    'phone.required' => 'Поле Телефон обезательное',
                    'password.required' => 'Поле Пароль обезательное',
                    'password.password_confirm' => 'Пароли должны совпадать',
                ];
                $validator = Validator::validate($data, $rules, $messages);
                $errors = $validator->getErrors();
                if (!empty($errors)) {
                    Session::setFlash('error', $errors);
                    header('Location: http://'.$_SERVER['HTTP_HOST']. "/register");
                } else {
                    return "yes";
                }
                die;
            }
        } else {
            throw new \Exception("Error: method is not allowed");
        }
    }
}