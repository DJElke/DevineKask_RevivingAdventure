<?php

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../dao/VacationDAO.php';
require_once __DIR__ . '/../dao/UserDAO.php';
require_once __DIR__ . '/../dao/CardDAO.php';

class EditorController extends Controller{

    function __construct() {
      $this->vacationDAO = new VacationDAO();
      $this->userDAO = new UserDAO();
      $this->cardDAO = new CardDAO();
    }

    public function editorIndex(){
      $this->set('title', 'start editing');
      $this->set('currentpage', 'editorIndex');
      $loggedInUser = 1;

      $vacation = $this->vacationDAO-> getVacationById($_GET['id']);
      $this->set('vacation', $vacation);

      $status = $this->vacationDAO-> getStatus($_GET['id'], $loggedInUser);
      $this->set('status', $status['status']);
    }

    public function photoEditor(){
      $this->set('title', 'PhotoEditor');
      $this->set('currentpage', 'photoEditor');
      $loggedInUser = 1;
      $vacationId = $_GET['id'];

      $vacation = $this->vacationDAO-> getVacationById($vacationId);
      $this->set('vacation', $vacation);

      $status = $this->vacationDAO-> getStatus($vacationId, $loggedInUser);
      $this->set('status', $status['status']);


      $cardsToEdit = array();
      $cardsFromVacation = $this->vacationDAO->getCardsFromVacation($vacationId);
      foreach($cardsFromVacation as $card){
          $cardToEdit = $this->cardDAO->getCardById($card['card_id']);
          array_push($cardsToEdit,$cardToEdit);
      }

      if(empty($_GET['cardToEdit']) || empty($_GET['cardCount'])){
        $this->set('card', $cardsToEdit[0]);
        $cardCount = 0;
        $this->set('cardCount', $cardCount);
        $cardPicturesArray = $this->cardDAO->getPictureIdsByCardId($cardsToEdit[0]['id']);
      } else {
        $cardCount = $_GET['cardCount'];
        $this->set('cardCount', $cardCount);
        $cardToEdit = $this->cardDAO->getCardById($_GET['cardToEdit']);
        $this->set('card', $cardToEdit);
        $cardPicturesArray = $this->cardDAO->getPictureIdsByCardId($cardToEdit['id']);
      }
      //foto ophalen
      foreach($cardPicturesArray as $cardPicture){
        $cardImage = $this->cardDAO->getImageById($cardPicture['picture_id']);
        if(strpos($cardImage[0]['image'], 'uploads') !== false){
          $imageUrl = $cardImage[0]['image'];
          $this->set('image', $imageUrl);
        }
      }

      if(!empty($_POST['action'])){
        if($_POST['action'] == 'add'){
          //add card to database
          if(!empty($_POST['cardId'])){
            $cardId = $_POST['cardId'];
          }
          if(!empty($_POST['title'])){
            $cardTitle = $_POST['title'];
          }
          if(!empty($_POST['image'])){
            $this->_base64ToPngAndUploadLocal($_POST['image'],$status,$loggedInUser);
          }
          if(!empty($_POST['description'])){
            $cardDescription = $_POST['description'];
          }

          //cardCount to int to use as parameter
          if(empty($_GET['cardCount'])){
            $cardCountInt = 0;
          }else{
            $cardCountInt = intval($_GET['cardCount']);
          }
          $cardCountInt += 1;
          //cardCount to string to use in header
          $cardCountStr = strval($cardCountInt);
          $i = 0;
          //loop over the cards
          for($i; $i <= count($cardsFromVacation); $i++){
            if($i == $cardCountInt){
              if($i == count($cardsFromVacation)){
                header('Location: index.php?page=involvedVacations&id='.$vacationId);
              }else{
                $nextCardId = strval($cardsFromVacation[$i]['card_id']);
                header('Location: index.php?page=photoEditor&id='.$vacationId.'&cardToEdit='.$nextCardId.'&cardCount='.$cardCountStr);
              }
            }
          }
        }
      }

      $participants = $this->vacationDAO-> getParticipants($vacationId);
      foreach($participants as $participant){
        if(strpos($participant['description'], "Owner") !== false){
          $owner = $participant['name'];
        } 
      }
      $this->set('owner', $owner);

      if($status['status'] == 0){
        if(empty($_GET['cardToEdit'])){
          $cardTitle = $this->cardDAO->getTitleById($cardsToEdit[0]['title_id']);
          $this->set('cardTitle', $cardTitle);
        }else{
          $cardTitle = $this->cardDAO->getTitleById($cardToEdit['title_id']);
          $this->set('cardTitle', $cardTitle);
        }
      }
    }

    private function _base64ToPngAndUploadLocal($base64, $status, $loggedInUser){
      $imgData = explode(',', $base64);
      $source = imagecreatefromstring(base64_decode($imgData[1]));
      $target_dir = 'uploads/';
      if($source !== false){
        if($status['status'] == 0){
          $fileNameCard = 'characterImage_';
        }
        if($status['status'] == 1){
          $fileNameCard = 'adventureImage_';
        }
        if($status['status'] == 2){
          $fileNameCard = 'itemImage_';
        }
      }
      $fileName = $fileNameCard.'edit_'.$loggedInUser.'.png';
      $imgUrl = $target_dir.$fileName;
      //save in uploads folder
      imagepng($source,$imgUrl,0);
      return $imgUrl;
    }
}

?>