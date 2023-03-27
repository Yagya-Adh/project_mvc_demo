<?php

namespace App\src;

use App\Controllers\Controller;

class Router
{

    public Response $response;

    public $getRoutes = [];
    public $postRoutes = [];

    public Controller $layout; // controller property

    public function __construct()
    {
    }

    public function get($path, $callback)
    {
        return  $this->getRoutes[$path] = $callback;
    }

    public function post($path, $callback)
    {
        return $this->postRoutes[$path] = $callback;
    }


    public function run()
    {
        $method = strtolower($_SERVER['REQUEST_METHOD']);
        $path = $_SERVER['PATH_INFO'] ?? '/';



        if ($method === 'get') {
            $callback = $this->getRoutes[$path] ?? null;
        } else {
            $callback = $this->postRoutes[$path] ?? null;
        }


        echo "<pre>";
        print_r($callback);
        echo "<pre>";
        exit;

        if (!$path) {
            $this->response->setStatusCode(404);
            echo $this->renderView("404");
        };

        return call_user_func($path, $this);
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
