<?php

return [
    '/' => [
        'route' => 'index/index',
        'middleware' => ['AuthMiddleware']
    ],
    'login' => [
        'route' => 'login/index'
    ],
    'register' => [
        'route' => 'register/index'
    ]
];
