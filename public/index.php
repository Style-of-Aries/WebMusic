<?php
session_start(); 
$controllerName = $_GET['controller'] ?? 'user';
$action = $_GET['action'] ?? 'index';
// echo $controllerName ."<br>". $action;
$controllerClass = $controllerName . 'Controller';
require_once "./../controllers/{$controllerClass}.php";
$controller = new $controllerClass();
$controller->$action();
?>