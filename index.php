<?php
ini_set('display_errors', '1');

use App\Controllers\RestaurantController;
use App\src\Application;


require './vendor/autoload.php';

$app = new Application(dirname(__DIR__));


$app->router->get('/', [new RestaurantController, 'home']);
$app->router->post('/', [new RestaurantController, 'home']);

$app->resolve();
