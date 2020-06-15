<?php

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../dao/VacationDao.php';


class StationController extends Controller{

    function __construct() {
      $this->vacationDAO = new VacationDAO();
    }

    public function ownerStation1() {
      $this->set('title', 'station 1');

      $participants = $this->vacationDAO-> getParticipants($_GET['id']);
      $this->set('participants', $participants);

      if (!empty($_POST['action'])) {
        if ($_POST['action'] == 'add'){
          $this->_handleAdd();
        }
      }
    }
  
  
    private function _handleAdd() {
  
      
      
  
      header('Location: index.php?page=ownedVacation');
      exit();
  
    }

   
}

?>