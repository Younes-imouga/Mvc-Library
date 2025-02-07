<?php
namespace App\Config;
use App\Core\Router;

class Route
{
    private static $router;

    public static function setRouter($router)
    {
        self::$router = $router;
    }

    public static function get($route, $callback)
    {
        self::addRoute('GET', $route, $callback);
    }

    public static function post($route, $callback)
    {
        self::addRoute('POST', $route, $callback);
    }

    private static function addRoute($method, $route, $callback)
    {
        if (!self::$router) {
            echo('Router not set. Call Route::setRouter() first.');
            die;
        }
        self::$router->add($method, $route, $callback);
    }
}
