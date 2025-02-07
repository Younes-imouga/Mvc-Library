<?php
namespace App\Core;

class Router
{
    public static $routes = [
        'GET' => [],
        'POST' => []
    ];

    public static function add($method, $route, $call)
    {
        $method = strtoupper($method);
        $route = preg_replace('/\{[a-zA-Z0-9_]+\}/', '([a-zA-Z0-9_]+)', $route);
        self::$routes[$method][$route] = $call;
    }

    public function dispatch($uri, $method) {
        $uri = parse_url($uri, PHP_URL_PATH);
        $method = strtoupper($method);


        foreach (self::$routes[$method] as $route => $callback) {
            if (preg_match('#^' . $route . '$#', $uri, $matches)) {
                array_shift($matches);

                if (is_array($callback)) {
                    $controller = new $callback[0]();
                    $method = $callback[1];
                    
                    return call_user_func_array([$controller, $method], $matches);
                }
                return call_user_func_array($callback, $matches);
            }
        }
        http_response_code(404);
        exit();
    }
}