<?php

use Symfony\Component\Dotenv\Dotenv;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
use Illuminate\Cache\CacheManager as CacheManager;


$dotenv = new Dotenv();
$dotenv->load(__DIR__.'/../.env');

$capsule = new Capsule;

$capsule->addConnection([
    "driver" => "mysql",
    "host" => $_ENV['DB_HOST'],
    "database" => $_ENV['DB_DATABASE'],
    "username" => $_ENV['DB_USER'],
    "password" => $_ENV['DB_PASSWORD']
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();
