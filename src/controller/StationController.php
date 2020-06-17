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
      $target_dir = "uploads/";
      $uploadedFiles = array();
      $cards = array();

      if($_POST['action'] == 'add'){
        $i = 0;
        foreach($_POST['cards'] as $card){
          $file = $_FILES['characterImage'.$i]['name'];
          $path = pathinfo($file);
          $filename = $path['filename'];
          $ext = $path['extension'];
          $tmpFilePath = $_FILES['characterImage'.$i]['tmp_name'];
          $path_filename_ext = $target_dir.$filename.".".$ext;
          move_uploaded_file($tmpFilePath,$path_filename_ext);
          array_push($uploadedFiles, $path_filename_ext);

          $card = array(
            'vacation_id' => $card['vacation_id'],
            'title' => $card['participant_name'] . ' is the ' . $card['characteristic'],
            'image' => $path_filename_ext
          );
          $i++;
          array_push($cards, $card);
        }
        unset($i);
        unset($_FILES);
      }
     
      $insertCards = $this->stationDAO->insertCharacterCard($cards);
      if ($insertCards) {
        $this->stationDAO->updateStatus($card['vacation_id'],$loggedInUser);
      }

      if (!$insertCards) {
        foreach($uploadedFiles as $file){
          unlink($file);
        }
        $errors = $this->stationDAO->validate($cards);
      }

      unset($uploadedFiles);
      header("Location: index.php?page=ownedVacation&id=" . $cards[0]['vacation_id']);
      exit();
    }

    private function _handleAddItemCard() {
      $loggedInUser = 1;

      $loggedInUser = 1;
      $target_dir = "uploads/";
      $uploadedFiles = array();
      $cards = array();

      if($_POST['action'] == 'add'){
        $i = 0;
        foreach($_FILES as $file){
          $file = $_FILES['itemCardImage'.$i]['name'];
          $path = pathinfo($file);
          $filename = $path['filename'];
          $ext = $path['extension'];
          $tmpFilePath = $_FILES['characterImage'.$i]['tmp_name'];
          $path_filename_ext = $target_dir.$filename.".".$ext;
          move_uploaded_file($tmpFilePath,$path_filename_ext);
          array_push($uploadedFiles, $path_filename_ext);

          $card = array(
            'vacation_id' => $_POST['vacation_id'],
            'image' => $path_filename_ext
          );
          $i++;
          array_push($cards, $card);
        }
        unset($i);
        unset($_FILES);
      }
     
      $insertCards = $this->stationDAO->insertItemCard($cards);
      if ($insertCards) {
        $this->stationDAO->updateStatus($card['vacation_id'],$loggedInUser);
      }

      if (!$insertCards) {
        foreach($uploadedFiles as $file){
          unlink($file);
        }
        $errors = $this->stationDAO->validate($cards);
      }

      unset($uploadedFiles);

      header("Location: index.php?page=ownedVacation&id=" . $_POST['vacation_id']);
      exit();
    }
  }
?>