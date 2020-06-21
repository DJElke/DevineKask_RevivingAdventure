<?php

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../dao/VacationDAO.php';
require_once __DIR__ . '/../dao/CardDAO.php';
require_once __DIR__ . '/../dao/StationDAO.php';


class ReviewController extends Controller{

    function __construct() {
      $this->vacationDAO = new VacationDAO();
      $this->cardDAO = new CardDAO();
      $this->stationDAO = new StationDAO();

    }

    public function reviewIndex() {
      $this->set('title', 'review');
      $loggedInUser = 1;
      $vacationId = $_GET['id'];
      $status = $this->vacationDAO-> getStatus($vacationId, $loggedInUser);
      $this->set('status', $status['status']);
      
    }

    public function review() {
      $this->set('title', 'review');
      $loggedInUser = 1;
      $vacationId = $_GET['id'];
      $this->set('vacationId', $vacationId);

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
        $descriptionIdArray = $this->cardDAO->getDescriptionIdsByCardId($cardsToReview[0]['id']);
        $titleIdArray = $this->cardDAO->getTitleIdsByCardId($cardsToReview[0]['id']);

      //if it is not the first time loaded
      } else {  
        $cardCount = $_GET['cardCount'];
        $this->set('cardCount', $cardCount);
        $cardToReview = $this->cardDAO->getCardById($_GET['cardToReview']);
        $this->set('card', $cardToReview);
        
        $picturesIdArray = $this->cardDAO->getPictureIdsByCardId($cardToReview['id']);
        $descriptionIdArray = $this->cardDAO->getDescriptionIdsByCardId($cardToReview['id']);
        $titleIdArray = $this->cardDAO->getTitleIdsByCardId($cardToReview['id']);
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


      //get titel of each character card
      if($status['status'] == 4){
        if(empty($_GET['cardToReview'])){
          $title = $this->cardDAO->getTitleDescriptionById($cardsToReview[0]['title_id']);
          $this->set('title', $title);
        }else{
          $title = $this->cardDAO->getTitleDescriptionById($cardToReview['title_id']);
          $this->set('title', $title);
        }
      //get titels of each item/adventure card
      }else{
        $titleArray = array();
        foreach($titleIdArray as $titleId){
          $title = $this->cardDAO->getTitleDescriptionById($titleId['title_id']);
          $titleDesc = $title['description'];
          array_push($titleArray,$titleDesc);
          
        }
        $this->set('titleArray', $titleArray);
      }

      //get descriptions of each picture
      $descriptionArray = array();
      foreach($descriptionIdArray as $descriptionId){
          $cardDescription = $this->cardDAO->getDescriptionById($descriptionId['description_id']);
          $description = $cardDescription['description'];
          array_push($descriptionArray,$description);
      }
      $this->set('descriptionArray', $descriptionArray);

      if(!empty($_POST['action'])){
        if($_POST['action'] == 'add'){
          //TODO? add card to database

          //update cardCount
          // if(empty($_GET['cardCount'])){
          //   $cardCountInt = 0;
          // }else{
            $cardCountInt = intval($_GET['cardCount']); //int to use as parameter
          // }
          $cardCountInt += 1;
          $cardCountStr = strval($cardCountInt);  //to string to use in header

          //loop over cards
          $i = 1;
          for($i; $i <= count($cardsFromVacation); $i++){
            if($i == $cardCountInt){
              if($i == count($cardsFromVacation)){
                $this->stationDAO->updateStatus($vacationId,$loggedInUser);
                header('Location: index.php?page=ownedVacation&id='.$vacationId);
              }else{
                $nextCardId = strval($cardsFromVacation[$i]['card_id']);
                header('Location: index.php?page=review&id='.$vacationId.'&cardToReview='.$nextCardId.'&cardCount='.$cardCountStr);
              }
            }
          }
        }
      }
    }
  }
?>