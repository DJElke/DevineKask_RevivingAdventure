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
    'home' => array (
      'controller' => 'Home',
      'action' => 'home'
    ),
    'editorIndex' => array (
      'controller' => 'Editor',
      'action' => 'editorIndex'
    ),
    'photoEditor' => array (
      'controller' => 'Editor',
      'action' => 'photoEditor'
    ),
    'handleEdit' => array (
      'controller' => 'Editor',
      'action' => 'handleEdit'
    ),
    'ownedVacation' => array (
      'controller' => 'Vacation',
      'action' => 'ownedVacation'
    ),
    'involvedVacation' => array (
      'controller' => 'Vacation',
      'action' => 'involvedVacation'
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
);

if(empty($_GET['page'])) {
    $_GET['page'] = 'home';
  }
  if(empty($routes[$_GET['page']])) {
    header('Location: home.php');
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