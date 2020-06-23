<?php

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../dao/VacationDAO.php';
require_once __DIR__ . '/../dao/UserDAO.php';
require_once __DIR__ . '/../dao/CardDAO.php';
require_once __DIR__ . '/../dao/StationDAO.php';
require_once __DIR__ . '/../dao/StickersDAO.php';

class EditorController extends Controller{

    function __construct() {
      $this->vacationDAO = new VacationDAO();
      $this->userDAO = new UserDAO();
      $this->cardDAO = new CardDAO();
      $this->stationDAO = new StationDAO();
      $this->stickersDAO = new StickersDAO();
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
      if($status['status'] == 0){
        $cardType = 1;
      }
      if($status['status'] == 1){
        $cardType = 2;
      }
      if($status['status'] == 2){
        $cardType = 3;
      }

      $cardsToEdit = array();
      $cardsFromVacation = $this->vacationDAO->getCardsFromVacation($vacationId, $cardType);
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
        $cardImage = $this->cardDAO->getImageUrlById($cardPicture['picture_id']);
        if(count($cardImage)!= 0){
          if(strpos($cardImage[0]['image'], 'uploads') !== false){
            $imageUrl = $cardImage[0]['image'];
            $this->set('image', $imageUrl);
          }
        }
      }

      if($status['status'] == 0){
        if(empty($_GET['cardToEdit'])){
          $title = $this->cardDAO->getTitleDescriptionById($cardsToEdit[0]['title_id']);
          $this->set('cardTitle', $title);
        }else{
          $title = $this->cardDAO->getTitleDescriptionById($cardToEdit['title_id']);
          $this->set('cardTitle', $title);
        }
      }else{
        $title = null;
        $this->set('cardTitle', $title);
      }

      $participants = $this->vacationDAO-> getParticipants($vacationId);
      foreach($participants as $participant){
        if(strpos($participant['description'], "Owner") !== false){
          $owner = $participant['name'];
        } 
      }
      $this->set('owner', $owner);

      //stickers ophalen
      $stickers = $this->stickersDAO->getStickerImages();
      $this->set('stickers', $stickers);

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
            $cardImage = $this->_base64ToPngAndUploadLocal($_POST['image'],$status,$loggedInUser, $_POST['cardId']);
          }
          if(!empty($_POST['description'])){
            $cardDescription = $_POST['description'];
          }
          //kijk of er een titel meegegeven is, anders voeg deze niet toe! 
          if(!empty($_POST['title'])){
            $editedCard = array(
              'card_id' => $cardId,
              'title' => $cardTitle,
              'description' => $cardDescription,
              'image' => $cardImage,
            );
          } else {
            $editedCard = array(
              'card_id' => $cardId,
              'description' => $cardDescription,
              'image' => $cardImage,
            );
          }
          $this->_handleAddEditedCard($editedCard, $vacationId, $loggedInUser);
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
                $this->stationDAO->updateStatus($vacationId,$loggedInUser);
                header('Location: index.php?page=involvedVacation&id='.$vacationId);
              }else{
                $nextCardId = strval($cardsFromVacation[$i]['card_id']);
                header('Location: index.php?page=photoEditor&id='.$vacationId.'&cardToEdit='.$nextCardId.'&cardCount='.$cardCountStr);
              }
            }
          }
        }
      }
    }

    //Image wordt opgeslagen als bv. editedImages/62_characterCard_edit_1.png
    private function _base64ToPngAndUploadLocal($base64, $status, $loggedInUser, $cardId){
      $imgData = explode(',', $base64);
      $source = imagecreatefromstring(base64_decode($imgData[1]));
      $target_dir = 'editedImages/'.$cardId;
      if($source !== false){
        if($status['status'] == 0){
          $fileNameCard = '_characterCard_';
        }
        if($status['status'] == 1){
          $fileNameCard = '_adventureCard_';
        }
        if($status['status'] == 2){
          $fileNameCard = '_itemCard_';
        }
      }
      $fileName = $fileNameCard.'edit_'.$loggedInUser.'.png';
      $imgUrl = $target_dir.$fileName;
      //save in uploads folder
      imagepng($source,$imgUrl,0);
      return $imgUrl;
    }

    private function _handleAddEditedCard($editedCard,$vacationId, $loggedInUser){
      if(!empty($editedCard['title'])){
        $insertedTitle = $this->cardDAO->insertTitle($editedCard['title']);
        if(empty($insertedTitle)){
          //do something with the errors
        }
        $this->cardDAO->insertCardTitle(intval($editedCard['card_id']), $insertedTitle);
      }
      $insertedDescription = $this->cardDAO->insertDescription($editedCard['description']);
      if(empty($insertedDescription)){
        //do something with the errors
      }
      $this->cardDAO->insertCardDescription(intval($editedCard['card_id']), $insertedDescription);
      $insertedImage = $this->cardDAO->insertImage($editedCard['image']);
      if(empty($insertedImage)){
        //do something with the erros
      }
      $this->cardDAO->insertCardPicture(intval($editedCard['card_id']), $insertedImage);
    }
}

?>