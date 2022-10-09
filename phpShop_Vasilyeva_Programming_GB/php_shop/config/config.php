<?php

use app\engine\Db;
use app\engine\Request;
use app\engine\Session;
use app\model\repositories\CartRepo;
use app\model\repositories\ProductRepo;
use app\model\repositories\UserRepo;
use app\model\repositories\OrderRepo;

return [
    'root_dir' =>  dirname(__DIR__),
    'controllers_namespace' => 'app\\controllers\\',
    'product_per_page' => 4,
    'components' => [
        'db' => [
            'class' => Db::class,
            'driver' => 'mysql',
            'host' => '127.0.0.1:8889',
            'login' => 'root',
            'password' => 'root',
            'database' => 'brand_shop',
            'charset' => 'utf8'
        ],
        'request' => [
            'class' => Request::class
        ],
        'cartRepo' => [
            'class' => CartRepo::class
        ],
        'productRepo' => [
            'class' => ProductRepo::class
        ],
        'userRepo' => [
            'class' => UserRepo::class
        ],
        'orderRepo' => [
            'class' => OrderRepo::class
        ],
        'session' => [
            'class' => Session::class
        ]
    ]
];

