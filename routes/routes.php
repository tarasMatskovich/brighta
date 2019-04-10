<?php

return [
    '/' => [
        'route' => 'index/index',
        'middleware' => ['AuthMiddleware']
    ],
    'login' => [
        'route' => 'login/index',
        'middleware' => ['GuestMiddleware']
    ],
    'loginuser' => [
        'route' => 'login/loginuser'
    ],
    'register' => [
        'route' => 'register/index',
        'middleware' => ['GuestMiddleware']
    ],
    'signup' => [
        'route' => 'register/signup'
    ],
    'logout' => [
        'route' => 'login/logout',
        'middleware' => ['AuthMiddleware']
    ],
];
