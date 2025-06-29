<?php
$controllerName = $_GET['controller'] ?? 'auth';
$action = $_GET['action'] ?? 'login';
$controllerClass = $controllerName . 'Controller';
require_once "./../controllers/{$controllerClass}.php";
$controller = new $controllerClass();
$controller->$action();
?>