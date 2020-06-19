<?php
session_start();
error_reporting(E_ALL);

// set locale for date formatting strftime
setlocale(LC_ALL, 'nl_BE');

// set routes
$routes = array(
    'login' => array (
      'controller' => 'Editor',
      'action' => 'index'
    ),
    'photoeditor' => array (
      'controller' => 'Editor',
      'action' => 'photoeditor'
    ),
    'home' => array (
      'controller' => 'Home',
      'action' => 'home'
    ),
    'ownedVacation' => array (
      'controller' => 'Vacation',
      'action' => 'ownedVacation'
    ),
    'ownerStation1' => array (
      'controller' => 'Station',
      'action' => 'ownerStation1'
    ),
    'ownerStation2' => array (
      'controller' => 'Station',
      'action' => 'ownerStation2'
    ),
    'ownerStation3' => array (
      'controller' => 'Station',
      'action' => 'ownerStation3'
    ),
    'station4' => array (
      'controller' => 'Station',
      'action' => 'station4'
    ),
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