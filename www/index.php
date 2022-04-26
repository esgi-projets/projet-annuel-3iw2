<?php

namespace App;

use App\Model\User as UserModel;

session_start();

require __DIR__ . "/vendor/autoload.php";

$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad(); // load .env file

function myAutoloader($class)
{
    //$class = App\Core\CleanWords
    $class = str_ireplace("App\\", "", $class);
    //$class = Core\CleanWords
    $class = str_ireplace("\\", "/", $class);
    //$class = Core/CleanWords
    if (file_exists($class . ".class.php")) {
        include $class . ".class.php";
    }
}

spl_autoload_register("App\myAutoloader");


$uri = $_SERVER["REQUEST_URI"];

$routeFile = "routes.yml";
if (!file_exists($routeFile)) {
    die("Le fichier " . $routeFile . " n'existe pas");
}

$routes = yaml_parse_file($routeFile);

// Load ressources files without routing
if ((strpos($uri, '.css') !== false || strpos($uri, '.js') !== false) && file_exists(dirname(__FILE__) . "/View/" . $uri)) {
    header("Content-Type: text/css");
    include(dirname(__FILE__) . "/View/" . $uri);
    exit;
} elseif (file_exists(dirname(__FILE__) . "/View/" . $uri) && $uri != "/") {
    include(dirname(__FILE__) . "/View/" . $uri);
    exit;
} elseif ((strpos($uri, '.css') !== false || strpos($uri, '.js') !== false) && !file_exists(dirname(__FILE__) . "/View/" . $uri)) {
    die("Page 404");
}

if (empty($routes[$uri]) || empty($routes[$uri]["controller"])  || empty($routes[$uri]["action"])) {
    die("Page 404");
}

$controller = ucfirst(strtolower($routes[$uri]["controller"]));
$action = strtolower($routes[$uri]["action"]);
$protected = isset($routes[$uri]["protected"]) && $routes[$uri]['protected'] || strpos($uri, "admin") !== false; // if URI contains admin or protected route is true

// if routes is protected and user is not logged in
if ($protected && !isset($_SESSION["user"])) {
    header("Location: /login");
    exit;
}

// $controller = User ou $controller = Global
// $action = login ou $action = logout ou $action = home

$controllerFile = "Controller/" . $controller . ".class.php";
if (!file_exists($controllerFile)) {
    die("Le controller " . $controllerFile . " n'existe pas");
}
include $controllerFile;

$controller = "App\\Controller\\" . $controller;
if (!class_exists($controller)) {
    die("La classe " . $controller . " n'existe pas");
}

$objectController = new $controller();

if (!method_exists($objectController, $action)) {
    die("La methode " . $action . " n'existe pas");
}

$objectController->$action();
