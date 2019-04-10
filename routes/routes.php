<?php

return [
    '/' => [
        'route' => 'index/index',
        'middleware' => ['AuthMiddleware']
    ],
    'login' => [
        'route' => 'login/index'
    ],
    'loginuser' => [
        'route' => 'login/loginuser'
    ],
    'register' => [
        'route' => 'register/index'
    ],
    'signup' => [
        'route' => 'register/signup'
    ]
];
