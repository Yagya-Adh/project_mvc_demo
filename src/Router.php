<?php

namespace App\src;

use App\Controllers\Controller;

class Router
{

    public Response $response;
    public Request $request;


    public Controller $controller;
    protected array $routes = [];

    public Controller $layout; // controller property

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function get($path, $callback)
    {
        return  $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        return $this->routes['post'][$path] = $callback;
    }


    public function run()
    {

        $path = $this->request->getPath();
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;

        if ($callback === false) {
            $this->response->setStatusCode(404);
            return $this->renderView("404");
        }


        if (is_string($callback)) {
            return $this->renderView($callback);
        }


        if (is_array($callback)) {
            $this->controller = new $callback[0];
            $callback[0] = $this->controller;
        }

        echo "<pre>";
        print_r($callback);
        echo "<pre>";
        exit;

        return call_user_func($callback, $this->request);
    }




    public function renderView($view, $params = [])
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view, $params);
        return str_replace('{{main}}', $viewContent, $layoutContent);
    }

    protected function layoutContent()
    {
        $layout = $this->layout;
        ob_start();
        include_once __DIR__ . "/../Views/restaurant/$layout.php";
        return ob_get_clean();
    }



    protected function renderOnlyView($view, $params)
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once __DIR__ . "/../Views/restaurant/$view.php";
        return ob_get_clean();
    }



    public function renderContent($viewContent)
    {
        $layoutContent = $this->layoutContent();
        return str_replace('{{main}}', $viewContent, $layoutContent);
    }
}
