<?php
require_once 'config/config.php';
require_once 'autoload.php';

session_start();

$controller = $_GET['controller'] ?? 'home';
$routes = require './routes.php';

if (isset($routes[$controller])) {
    require_once $routes[$controller];
} else {
    require_once 'controller/HomeController.php';
}
