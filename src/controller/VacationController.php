<?php
require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../dao/VacationDao.php';
require_once __DIR__ . '/../dao/UserDao.php';


class VacationController extends Controller {
  function __construct() {
    $this->vacationDAO = new VacationDAO();
    $this->userDAO = new UserDAO();
  }

  public function ownedVacation() {
    $this->set('title', 'vacation');
    $this->set('currentpage', 'vacation');
    $loggedInUser = 1;

    $vacation = $this->vacationDAO-> getVacationName($_GET['id']);
    $this->set('vacation', $vacation);

    $participants = $this->vacationDAO-> getParticipants($_GET['id']);
    $this->set('participants', $participants);
    
    $status = $this->vacationDAO-> getStatus($_GET['id'], $loggedInUser);
    $this->set('status', $status['status']);
  }

  public function involvedVacation() {
    $this->set('title', 'vacation');
    $this->set('currentpage', 'vacation');
    $loggedInUser = 1;

    $vacation = $this->vacationDAO-> getVacationName($_GET['id']);
    $this->set('vacation', $vacation);    

    $participants = $this->vacationDAO-> getParticipants($_GET['id']);
    $this->set('participants', $participants);

    $status = $this->vacationDAO-> getStatus($_GET['id'], $loggedInUser);
    $this->set('status', $status['status']);
  }

}
