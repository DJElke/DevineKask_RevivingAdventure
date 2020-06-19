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
          $cardToEdit = $this->cardDAO->getCardAndImage($card['card_id']);
          array_push($cardsToEdit,$cardToEdit);
      }

      if(empty($_GET['cardToEdit']) || empty($_GET['cardCount'])){
        $this->set('card', $cardsToEdit[0]);
        $cardCount = 0;
        $this->set('cardCount', $cardCount);
      } else {
        $cardCount = $_GET['cardCount'];
        $this->set('cardCount', $cardCount);
        $cardToEdit = $this->cardDAO->getCardAndImage($_GET['cardToEdit']);
        $this->set('card', $cardToEdit);
      }

      if(!empty($_POST['action'])){
        if($_POST['action'] == 'add'){
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
          for($i; $i <= count($cardsFromVacation); $i++){
            if($i == $cardCountInt){
              if($i == count($cardsFromVacation)){
                header('Location: index.php?page=home');
              }else{
                $cardId = strval($cardsFromVacation[$i]['card_id']);
                header('Location: index.php?page=photoEditor&id='.$vacationId.'&cardToEdit='.$cardId.'&cardCount='.$cardCountStr);
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
}

?>