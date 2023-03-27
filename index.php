<?php

use App\Controllers\RestaurantController;

use App\src\Router;

require './vendor/autoload.php';

$router = new Router();

$router->get('/', [new RestaurantController, 'home']);
$router->post('/', [new RestaurantController, 'home']);

$router->run();
