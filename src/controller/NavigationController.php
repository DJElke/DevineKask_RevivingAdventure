<?php

require_once __DIR__ . '/Controller.php';

class NavigationController extends Controller{

    function __construct() {
    }

    public function index(){
      $this->set('title', 'Login');
      $this->set('currentpage', 'login');
    }

    public function dashboard(){
      $this->set('title', 'Dashboard');
      $this->set('currentpage', 'dashboard');
    }

    public function photoeditor(){
      $this->set('title', 'PhotoEditor');
      $this->set('currentpage', 'photoeditor');
    }
}

?>