<?php

namespace App\src;

use App\Controllers\Controller;

/**
 *
 * @author yagya <yagyaadhikari02@gmail.com>
 * @package   app\core
 */


class Application
{
    public static string $ROOT;
    public Request $request;
    public Response $response;
    public Router $router;
    public Controller $controller;

    public static Application $app;


    public function __construct($root)
    {
        self::$ROOT = $root;
        self::$app = $this; // 

        $this->request = new Request();
        $this->response = new Response();

        $this->router = new Router($this->request);
    }


    public function resolve()
    {
        return $this->router->run();
    }

    public function getController(Controller $controller)
    {
        $this->controller = $controller;
    }


    public function setController(Controller $controller)
    {
        $this->controller = $controller;
    }
}
