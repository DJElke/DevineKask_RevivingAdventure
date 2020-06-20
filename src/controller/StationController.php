<?php

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../dao/VacationDAO.php';
require_once __DIR__ . '/../dao/StationDAO.php';
require_once __DIR__ . '/../dao/DesignDAO.php';


class StationController extends Controller{

    function __construct() {
      $this->vacationDAO = new VacationDAO();
      $this->stationDAO = new StationDAO();
      $this->designDAO = new DesignDAO();

    }

    public function ownerStation1() {
      $this->set('title', 'station 1');

      $participants = $this->vacationDAO-> getParticipants($_GET['id']);
      $this->set('participants', $participants);
      
      $vacationId = $_GET['id'];
      $this->set('vacationId', $vacationId);

      if (!empty($_POST['action'])) {
        $this->_handleAddCharacterCard();
      }
      
    }

    public function ownerStation2() {
      $this->set('title', 'station 2');

      $participants = $this->vacationDAO-> getParticipants($_GET['id']);
      $this->set('participants', $participants);

      $vacationId = $_GET['id'];
      $this->set('vacationId', $vacationId);

      if (!empty($_POST['action'])) {
        $this->_handleAddItemCard();
      }
      
    }

    public function ownerStation3() {
      $this->set('title', 'station 3');

      $participants = $this->vacationDAO-> getParticipants($_GET['id']);
      $this->set('participants', $participants);

      $vacationId = $_GET['id'];
      $this->set('vacationId', $vacationId);

      if (!empty($_POST['action'])) {
        $this->_handleAddAdventureCard();
      }
      
    }

    public function station4() {
      $this->set('title', 'station 4');

      $designs = $this->designDAO-> getDesigns();
      $this->set('designs', $designs);

      $vacationId = $_GET['id'];
      $this->set('vacationId', $vacationId);

      if (!empty($_POST['action'])) {
        $this->_handleRegisterVote();
      }
      
    }

    public function station5() {
      
      
    }
  
    private function _handleAddCharacterCard() {
      $loggedInUser = 1;
      $target_dir = "uploads/";
      $uploadedFiles = array();
      $cards = array();

      if($_POST['action'] == 'add'){
        $i = 0;
        foreach($_POST['cards'] as $card){
          //upload images
          $file = $_FILES['characterImage'.$i]['name'];
          $path = pathinfo($file);
          $filename = $path['filename'];
          $ext = $path['extension'];
          $tmpFilePath = $_FILES['characterImage'.$i]['tmp_name'];
          $path_filename_ext = $target_dir.$filename.".".$ext;
          move_uploaded_file($tmpFilePath,$path_filename_ext);
          array_push($uploadedFiles, $path_filename_ext);

          //make path NULL if input is not correct 
          $title = '';
          if(isset($card['characteristic'])) 
          {
            $title = $card['participant_name'] . ' is the ' . $card['characteristic'];
          }

          if(!isset($path['extension'])) 
          {
            $path_filename_ext = '';
          }
          

          $card = array(
            'vacation_id' => $card['vacation_id'],
            'title' => $title,
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
        unset($uploadedFiles);
        header("Location: index.php?page=ownerStation1&id=".$card['vacation_id']);
        exit();
      }

      unset($uploadedFiles);
      header("Location: index.php?page=ownedVacation&id=" . $cards[0]['vacation_id']);
      exit();
    }

    private function _handleAddItemCard() {
      $loggedInUser = 1;
      $target_dir = "uploads/";
      $uploadedFiles = array();
      $cards = array();

      if($_POST['action'] == 'add'){
        $i = 0;
        foreach($_FILES as $file){
          //upload images
          $file = $_FILES['itemImage'.$i]['name'];
          $path = pathinfo($file);
          $filename = $path['filename'];
          $ext = $path['extension'];
          $tmpFilePath = $_FILES['itemImage'.$i]['tmp_name'];
          $path_filename_ext = $target_dir.$filename.".".$ext;
          move_uploaded_file($tmpFilePath,$path_filename_ext);
          array_push($uploadedFiles, $path_filename_ext);

          //make path NULL if input is not correct
          if(!isset($path['extension'])) 
          {
            $path_filename_ext = '';
          }

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
        unset($uploadedFiles);
        header("Location: index.php?page=ownerStation2&id=" . $card['vacation_id']);
        exit();
      }

      unset($uploadedFiles);
      header("Location: index.php?page=ownedVacation&id=" . $_POST['vacation_id']);
      exit();
    }

    private function _handleAddAdventureCard() {
      $loggedInUser = 1;
      $target_dir = "uploads/";
      $uploadedFiles = array();
      $cards = array();

      if($_POST['action'] == 'add'){
        $i = 0;
        foreach($_FILES as $file){
          //upload images
          $file = $_FILES['adventureImage'.$i]['name'];
          $path = pathinfo($file);
          $filename = $path['filename'];
          $ext = $path['extension'];
          $tmpFilePath = $_FILES['adventureImage'.$i]['tmp_name'];
          $path_filename_ext = $target_dir.$filename.".".$ext;
          move_uploaded_file($tmpFilePath,$path_filename_ext);
          array_push($uploadedFiles, $path_filename_ext);

          //make path NULL if input is not correct
          if(!isset($path['extension'])) 
          {
            $path_filename_ext = '';
          }

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
        unset($uploadedFiles);
        header("Location: index.php?page=ownerStation3&id=".$card['vacation_id']);
        exit();
      }

      unset($uploadedFiles);

      header("Location: index.php?page=ownedVacation&id=" . $_POST['vacation_id']);
      exit();
    }

    private function _handleRegisterVote() {
      $loggedInUser = 1;

      if($_POST['action'] == 'add'){
        $this->designDAO->registerVote($loggedInUser, $_POST['design--option']);
        $this->stationDAO->updateStatus($_POST['vacation_id'],$loggedInUser);
      }

      header("Location: index.php?page=ownedVacation&id=" . $_POST['vacation_id']);
      exit();
    }
  }
?>