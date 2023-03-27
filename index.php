<?php

use App\Controllers\RestaurantController;
use App\src\Application;
use App\src\Request;
use App\src\Router;

require './vendor/autoload.php';

$app = new Application(dirname(__DIR__));


$app->router->get('/', [new RestaurantController, 'home']);
$app->router->post('/', [new RestaurantController, 'home']);

$app->resolve();
