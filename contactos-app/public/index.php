<?php
require __DIR__ . '/../vendor/autoload.php';
use App\Router;
echo 'inicio';
$router=new Router();
$router->dispatch();
//var_dump($router);
