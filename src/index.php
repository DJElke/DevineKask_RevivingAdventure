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
    'onboarding' => array (
      'controller' => 'Statisch',
      'action' => 'onboarding'
    ),
    'register' => array (
      'controller' => 'Statisch',
      'action' => 'register'
    ),
    'createAdventure' => array (
      'controller' => 'Statisch',
      'action' => 'createAdventure'
    ),
    'order' => array (
      'controller' => 'Statisch',
      'action' => 'order'
    ),
    'guide' => array (
      'controller' => 'Statisch',
      'action' => 'guide'
    ),
    'rules' => array (
      'controller' => 'Statisch',
      'action' => 'rules'
    ),
    'profile' => array (
      'controller' => 'Statisch',
      'action' => 'profile'
    ),
    'tutorial' => array (
      'controller' => 'Statisch',
      'action' => 'tutorial'
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
    'station4' => array (
      'controller' => 'Station',
      'action' => 'station4'
    ),
    'reviewIndex' => array (
      'controller' => 'Review',
      'action' => 'reviewIndex'
    ),
    'review' => array (
      'controller' => 'Review',
      'action' => 'review'
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