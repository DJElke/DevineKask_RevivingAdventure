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
        $this->_handleAddCharacterCard();
      }
      
    }

    public function ownerStation2() {
      $this->set('title', 'station 2');

      $participants = $this->vacationDAO-> getParticipants($_GET['id']);
      $this->set('participants', $participants);

      if (!empty($_POST['action'])) {
        $this->_handleAddItemCard();
      }
      
    }
  
    private function _handleAddCharacterCard() {
      $loggedInUser = 1;


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
     
      // $insertCards = $this->stationDAO->insertCharacterCard($cards);
      // if (!empty($insertCards)) {
      //   $this->stationDAO->updateStatus($card['vacation_id'],$loggedInUser);
      // }

      if (empty($insertCards)) {
        $errors = $this->stationDAO->validate($cards);
      }

      header("Location: index.php?page=ownedVacation&id=" . $cards[0]['vacation_id']);
      exit();
    }

    private function _handleAddItemCard() {
      $loggedInUser = 1;


      $cards = array();

      if($_POST['action'] == 'add'){
        
        }
     
      // $insertCards = $this->stationDAO->insertCharacterCard($cards);
      // if (!empty($insertCards)) {
      //   $this->stationDAO->updateStatus($card['vacation_id'],$loggedInUser);
      // }

      if (empty($insertCards)) {
        $errors = $this->stationDAO->validate($cards);
      }

      header("Location: index.php?page=ownedVacation&id=" . $_POST['vacation_id']);
      exit();
    }
  }
?>