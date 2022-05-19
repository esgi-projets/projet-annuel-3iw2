<?php

namespace App;

use App\Core\Auth;
use App\Core\Validator;

session_start();

require __DIR__ . "/vendor/autoload.php"; // Composer autoload

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

if (!isset($_SERVER['REQUEST_URI'])) {
    // locally accessed
    return;
}


$uri = $_SERVER["REQUEST_URI"];
$params = [];

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

// Dynamic routing
foreach (array_keys($routes) as $route) {
    if (preg_match("#^/" . explode('/', $route)[1] . "/\w+.*$#", $uri, $matches) && preg_match_all("#:\w+$#", $route, $params)) {
        $params_initials = $params[0];
        $offset = array_search($params_initials[0], explode('/', $route));

        $params = array_filter(array_slice(explode('/', $uri), $offset));

        // associate params with their values
        foreach (array_keys($params) as $key_param) {
            if (isset($params_initials[$key_param])) {
                $params[str_replace(":", "", $params_initials[$key_param])] = $params[$key_param];
                unset($params[$key_param]);
            } else {
                unset($params[$key_param]);
            }
        }

        $uri = $route;
        break;
    }
}

if (empty($routes[$uri]) || empty($routes[$uri]["controller"])  || empty($routes[$uri]["action"])) {
    die("Page 404");
}

$controller = ucfirst(strtolower($routes[$uri]["controller"]));
$action = strtolower($routes[$uri]["action"]);
$protected = isset($routes[$uri]["protected"]) && $routes[$uri]['protected'] || strpos($uri, "admin") !== false; // if URI contains admin or protected route is true

// if routes is protected and user is not logged in
if ($protected && Auth::isLogged() === false) {
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

$_GET = array_merge($_GET, Validator::sanitizeArray($params));
$_POST = Validator::sanitizeArray($_POST);

$objectController->$action();
