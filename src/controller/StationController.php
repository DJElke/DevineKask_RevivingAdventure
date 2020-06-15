<?php

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../dao/VacationDao.php';
require_once __DIR__ . '/../dao/StationDao.php';

class StationController extends Controller{

    function __construct() {
      $this->vacationDAO = new VacationDAO();
      $this->stationDAO = new StationDAO();
    }

    public function ownerStation1() {
      $this->set('title', 'station 1');

      $participants = $this->vacationDAO-> getParticipants($_GET['id']);
      $this->set('participants', $participants);

      if (!empty($_POST['action'])) {
        $this->_handleAdd();
      }
      
    }
  
  
    private function _handleAdd() {
  
      $cards = array();

      if($_POST['action'] == 'add'){
        $i = 0;
        foreach($_POST['cards'] as $card){
          $card = array(
            'vacation_id' => $card['vacation_id'],
            'title' => $card['participant_name'] . ' is the ' . $card['characteristic'],
          );
          $i++;
          array_push($cards, $card);
        }
        unset($i);
      }
     
      $insertCards = $this->stationDAO->insertCharacterCard($cards);
      // if (empty($insertCards)) {
      //   $errors = $this->stationDAO->validate($cards);
      // }
      
      header('Location: index.php?page=ownedVacation');
      exit();
    }
  }
?>