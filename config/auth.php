<?php

return [
    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],
    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        'api' => [
            'driver' => 'token',
            'provider' => 'users',
        ],
        'admin' => [
            'driver' => 'session',
            'provider' => 'admins',
        ],
        'admin-api' => [
            'driver' => 'token',
            'provider' => 'admins',
        ],
        'pengajar' => [
            'driver' => 'session',
            'provider' => 'pengajars',
        ],
        'pengajar-api' => [
            'driver' => 'token',
            'provider' => 'pengajars',
        ],
    ],
    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\User::class,
        ],
        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Admin::class,
        ],
        'pengajars' => [
            'driver' => 'eloquent',
            'model' => App\Operator::class,
        ],
    // 'users' => [
    //     'driver' => 'database',
    //     'table' => 'users',
    // ],
    ],
    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
        ],
        'admis' => [
            'provider' => 'admis',
            'table' => 'password_resets',
            'expire' => 15,
        ],
        'pengajars' => [
            'provider' => 'pengajars',
            'table' => 'password_resets',
            'expire' => 15,
        ],
    ],
];
