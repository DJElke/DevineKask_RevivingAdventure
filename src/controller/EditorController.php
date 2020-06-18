<?php

require_once __DIR__ . '/Controller.php';

class EditorController extends Controller{

    function __construct() {
    }

    public function index(){
      $this->set('title', 'Login');
      $this->set('currentpage', 'login');
    }

    public function photoeditor(){
      $this->set('title', 'PhotoEditor');
      $this->set('currentpage', 'photoeditor');
    }
}

?>