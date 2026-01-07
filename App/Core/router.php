<?php

namespace App\Core;

use Database;

class Router {
    private array $routes = [];
    public function get($url,$controller){
        $this->routes['GET'][$url] = $controller;
    }
    public function post($url, $controller){
        $this->routes['POST'][$url] = $controller;
    }
    public function dispatch(){
        


        $url = parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);
        $requestmethode = $_SERVER['REQUEST_METHOD'];
        if(isset($this->routes[$requestmethode][$url])){
            [$controllerName , $methodeName] = explode('@', $this->routes[$requestmethode][$url]);
            $controllerClass = "App\\Controllers\\$controllerName";
            $controller = new $controllerClass();
            $controller->$methodeName();
            return;
        }else{
            $controllerClass = "App\\Controllers\\ErrorController";
            $controller = new $controllerClass();
            $controller->notFound();
            return;
        };

    }
}
