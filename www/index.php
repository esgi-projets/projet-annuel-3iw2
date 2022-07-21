<?php

namespace App;

use App\Controller\Page;
use App\Controller\Errors;
use App\Core\Auth;
use App\Core\Validator;
use Symfony\Component\Yaml\Yaml;
use App\Model\Page as PageModel;
use App\Model\User;

session_start();

require __DIR__ . "/vendor/autoload.php"; // Composer autoload

$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad(); // load .env file

// error_reporting(0);

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

function catchError()
{
    $error = error_get_last();
    if ($error['type'] === E_ERROR) {
        if (Auth::isLogged() && Auth::getUser()->getRole() === "admin") {
            echo "<h1>Error</h1>";
            echo "Vous êtes connecté en tant qu'administrateur, vous pouvez voir le message d'erreur ci-dessous :<br>";
            echo "<pre>";
            print_r($error);
            echo "</pre>";
            exit;
        } else {
            header("HTTP/1.1 500 Internal Server Error");
            $error = new Errors();
            $error->error500();
            exit;
        }
    }
}

spl_autoload_register("App\myAutoloader");
//register_shutdown_function("App\catchError");

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

$routes = Yaml::parseFile($routeFile);

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

$pages = new PageModel();
$pagesRoute = $pages->getRoutes();

foreach ($pagesRoute as $page) {
    if ($uri == $page->slug) {
        $controller = new Page();
        $controller->viewPage($page->id);
        return;
    }
}

// if ? in URI => set params to GET

if (strpos($uri, "?") !== false) {
    $uri = explode("?", $uri);
    $uri = $uri[0];
    $params = $_GET;
}

// Dynamic routing
foreach (array_keys($routes) as $route) {
    if (preg_match("#^/" . explode('/', $route)[1] . "/\w+.*$#", $uri, $matches) && preg_match_all("#:\w+$#", $route, $matches)) {
        $params_initials = $matches[0];
        $offset = array_search($params_initials[0], explode('/', $route));

        $params = array_filter(array_slice(explode('/', $uri), $offset));

        if (str_replace($params_initials, "", $route) == str_replace($params, "", $uri)) {
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
}

if (empty($routes[$uri]) || empty($routes[$uri]["controller"])  || empty($routes[$uri]["action"])) {
    $error = new Errors();
    $error->error404();
    exit;
}

$controller = ucfirst(strtolower($routes[$uri]["controller"]));
$action = strtolower($routes[$uri]["action"]);
$protected = isset($routes[$uri]["protected"]) && $routes[$uri]['protected'] || strpos($uri, "admin") !== false; // if URI contains admin or protected route is true
$role = isset($routes[$uri]["role"]) ? $routes[$uri]["role"] : false; // if role is set in route

// if routes is protected and user is not logged in
if ($protected && Auth::isLogged() === false) {
    header("Location: /login");
    exit;
}

// if route need a role 
if ($protected && $role && Auth::getUser()->getRole() !== $role) {
    $error = new Errors();
    $error->error404();
    exit;
}

// if user token is expired
if (Auth::isLogged()) {
    $user = new User();
    $find = $user->find('token', Auth::getUser()->getToken(), User::class);
    if (empty($find)) {
        session_destroy();
        header("Location: /login");
        exit;
    }
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
