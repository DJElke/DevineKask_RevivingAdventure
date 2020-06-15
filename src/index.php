<?php
session_start();
error_reporting(E_ALL);

// set locale for date formatting strftime
setlocale(LC_ALL, 'nl_BE');

// set routes
$routes = array(
    'login' => array (
      'controller' => 'Navigation',
      'action' => 'index'
    ),
    'dashboard' => array (
      'controller' => 'Navigation',
      'action' => 'dashboard'
    ),
    'photoeditor' => array (
      'controller' => 'Navigation',
      'action' => 'photoeditor'
    )
);

if(empty($_GET['page'])) {
    $_GET['page'] = 'login';
  }
  if(empty($routes[$_GET['page']])) {
    header('Location: index.php');
    exit();
  }

$route = $routes[$_GET['page']];
$controllerName = $route['controller'] . 'Controller';

require_once __DIR__ . '/controller/' . $controllerName . ".php";

$controllerObj = new $controllerName();
$controllerObj->route = $route;
$controllerObj->filter();
$controllerObj->render();
?>