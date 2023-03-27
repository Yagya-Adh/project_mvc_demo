<?php

namespace App\src;

use App\src\Request;
use App\src\Response;
use App\src\Router;

class Application
{


    public static $ROOT;
    public Request $request;
    public Response $response;
    public Router $router;

    public function __construct($root)
    {
        self::$ROOT;
        $this->request = new Request();
        $this->router = new Router($this->request);
    }


    public function resolve()
    {

        return $this->router->run();
    }
}
