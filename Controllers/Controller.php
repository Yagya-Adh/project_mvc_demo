<?php

namespace App\Controllers;

use App\src\Application;
use App\src\Router;

abstract class Controller
{
    public Router $router;
    public string $layout = 'main';

    public function setLayout($layout)
    {
        $this->layout = $layout;
    }


    public function render($view)
    {
        return Application::$app->router->renderView($view);
    }
}
