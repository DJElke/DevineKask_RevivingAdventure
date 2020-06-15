<?php
require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../dao/HomeDao.php';
require_once __DIR__ . '/../dao/UserDao.php';


class HomeController extends Controller {
  private $homeDAO;

  function __construct() {
    $this->homeDAO = new HomeDAO();
    $this->userDAO = new UserDAO();

  }

  public function home() {
    $this->set('title', 'home');
    $loggedInUser = 1;

    $this->set('currentpage', 'home');

    //check if user is logged in
    // if(!empty($_GET['id'])){
      $user = $this->userDAO-> getUserName($loggedInUser);
      $this->set('user', $user['name']);
    // }

    //get owned vacations
    //if(!empty($_GET['id'])){
      $vacations = $this->homeDAO-> getOwnedVacations($loggedInUser);
      $this->set('vacations', $vacations);
    //}

  }
}
