<?php

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../dao/VacationDAO.php';
require_once __DIR__ . '/../dao/StationDAO.php';
require_once __DIR__ . '/../dao/DesignDAO.php';
require_once __DIR__ . '/../dao/CardDAO.php';


class StationController extends Controller{

    function __construct() {
      $this->vacationDAO = new VacationDAO();
      $this->stationDAO = new StationDAO();
      $this->designDAO = new DesignDAO();
      $this->cardDAO = new CardDAO();

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

    public function station5Index() {
      $this->set('title', 'station 5');

      
    }

    public function station5() {
      $this->set('title', 'station 4');
      $loggedInUser = 1;
      $vacationId = $_GET['id'];

      //get status om cardtype te bepalen
      $status = $this->vacationDAO-> getStatus($vacationId, $loggedInUser);
      $this->set('status', $status['status']);
      if($status['status'] == 4){
        $cardType = 1;
      }
      if($status['status'] == 5){
        $cardType = 2;
      }
      if($status['status'] == 6){
        $cardType = 3;
      }

      //get cards to review
      $cardsToReview = array();
      $cardsFromVacation = $this->vacationDAO->getCardsFromVacation($vacationId, $cardType);
      foreach($cardsFromVacation as $card){
          $cardToReview = $this->cardDAO->getCardById($card['card_id']);
          array_push($cardsToReview,$cardToReview);
      }

      //check if this is the first time the page is loaded
      if(empty($_GET['cardToReview']) || empty($_GET['cardCount'])){
        $this->set('card', $cardsToReview[0]);
        $cardCount = 0;
        $this->set('cardCount', $cardCount);
        $picturesIdArray = $this->cardDAO->getPictureIdsByCardId($cardsToReview[0]['id']);
        //$titleArray
        //$descriptionArray
      } else {  
        $cardCount = $_GET['cardCount'];
        $this->set('cardCount', $cardCount);
        $cardToReview = $this->cardDAO->getCardById($_GET['cardToReview']);
        $this->set('card', $cardToReview);
        
        $picturesIdArray = $this->cardDAO->getPictureIdsByCardId($cardToReview['id']);
        //$titleArray
        //$descriptionArray
      }

      //get url of each picture
      $imageUrlArray = array();
      foreach($picturesIdArray as $pictureId){
        $cardImage = $this->cardDAO->getImageUrlById($pictureId['picture_id']);
        if(strpos($cardImage[0]['image'], 'editedImages') !== false){
          $imageUrl = $cardImage[0]['image'];
          array_push($imageUrlArray,$imageUrl);
        }
      }
      $this->set('imageUrlArray', $imageUrlArray);


      if($status['status'] == 4){
        if(empty($_GET['cardToReview'])){
          $title = $this->cardDAO->getTitleDescriptionById($cardsToReview[0]['title_id']);
          $this->set('title', $title);
        }else{
          $title = $this->cardDAO->getTitleDescriptionById($cardToEdit['title_id']);
          $this->set('cardTitle', $title);
        }
      }else{

        //TODO: laadt titels in van item cards en adventure cards

        // $title = null;
        // $this->set('cardTitle', $title);
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
      $vacationId = $_POST['vacation_id'];

      if($_POST['action'] == 'add'){
        $vacUser = $this->stationDAO->getVacUserByUserIdAndVacId($loggedInUser, $vacationId);
        $this->designDAO->registerVote($vacUser['id'],$_POST['design--option']);
        $this->stationDAO->updateStatus($vacationId, $loggedInUser);

        if($vacUser['userrole_id'] == 1){
          header("Location: index.php?page=ownedVacation&id=" . $vacationId);
          exit();
        }
        if($vacUser['userrole_id'] == 2){
          header("Location: index.php?page=involvedVacation&id=" . $vacationId);
          exit();
        }
      }
    }
  }
?>