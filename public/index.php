<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
use App\Controllers\front\authcontroller;
use App\Controllers\front\ClientController;
use App\Controllers\back\adminController;
use App\Core\Router;
use App\Config\Route;
use App\Core\database;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$db = new database;
$db->connect();

$router = new Router;
Route::setRouter($router);

if (!isset($_SESSION['logged_in'])) {
    Route::get("/", [authcontroller::class, 'renderSignUp']);
} else {
    if (isset($_SESSION['is_admin'])) {
        Route::get("/", [authcontroller::class, 'renderDashboard']);
    } else {
        Route::get("/home", [authcontroller::class, 'renderHome']);
    }
}

Route::get("/signup", [authcontroller::class, 'renderSignUp']);
Route::get("/login", [authcontroller::class, 'renderLogin']);

Route::post("/login", [authcontroller::class, 'login']);
Route::post("/signup", [authcontroller::class, 'signup']);

Route::get("/logout", [authcontroller::class, 'logout']);

Route::get("/home", [ClientController::class, 'renderHome']);
Route::get("/dashboard", [adminController::class, 'renderDashboard']);

$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);