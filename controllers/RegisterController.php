<?php


namespace App\Controllers;

use App\Components\View;
use App\Components\Validator;
use App\Components\Session;
use App\Models\User;

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
                    if (!empty(User::where(['email' => $data['email']])::get())) {
                        Session::setFlash('error', [['Пользователь с таким email уже существует в системе']]);
                        header('Location: http://'.$_SERVER['HTTP_HOST']. "/register");
                    } else {
                        if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
                            $types = array('image/gif', 'image/png', 'image/jpeg');
                            if (!in_array($_FILES['image']['type'], $types)) {
                                Session::setFlash('error', [['Можно загрузить только файлы изображения (gif,png,jpg)']]);
                                header('Location: http://'.$_SERVER['HTTP_HOST']. "/register");
                                die;
                            } else {
                                $name = time() . $_FILES['image']['name'];
                                $fileName = "public/images/" . $name;
                                copy($_FILES['image']['tmp_name'], $fileName);
                                $data['image'] = $name;
                            }
                        }
                        $result = $this->saveUser($data);
                        if ($result) {
                            Session::setFlash('success', [['Вы были успешно зарегистрированы']]);
                            header('Location: http://'.$_SERVER['HTTP_HOST']. "/");
                        } else {
                            Session::setFlash('error', [['При регистрации произошла ошибка, повторите попытку пожже']]);
                            header('Location: http://'.$_SERVER['HTTP_HOST']. "/register");
                        }
                    }
                }
            }
        } else {
            throw new \Exception("Error: method is not allowed");
        }
    }

    protected function saveUser($data)
    {
        $user = new User();
        $user->email = $data['email'];
        $user->name = $data['name'];
        $user->surname = $data['surname'];
        $user->phone = $data['phone'];
        $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
        if (isset($data['image'])) {
            $user->img = $data['image'];
        }
        $result = $user->save();
        if ($result) {
            Session::set('user', $user);
        }
        return $result;
    }
}