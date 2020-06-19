<?php

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../dao/VacationDao.php';
require_once __DIR__ . '/../dao/UserDao.php';
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

      $vacation = $this->vacationDAO-> getVacationById($_GET['id']);
      $this->set('vacation', $vacation);

      $status = $this->vacationDAO-> getStatus($_GET['id'], $loggedInUser);
      $this->set('status', $status['status']);

      $cardsToEdit = array();
      if(empty($_GET['cardToEdit'])){
        $cardCount = 0;
        $cardsFromVacation = $this->vacationDAO->getCardsFromVacation($_GET['id']);
        foreach($cardsFromVacation as $card){
          $cardToEdit = $this->cardDAO->getCardAndImage($card['card_id']);
          array_push($cardsToEdit,$cardToEdit);
        }
        $this->set('card', $cardsToEdit[0]);
      }else{
        $cardCount = $_GET['cardCount'];
        $cardToEdit = $this->cardDAO->getCardAndImage($_GET['cardToEdit']);
        $this->set('card', $cardToEdit);
      }
      $this->set('cardCount', $cardCount);

      $participants = $this->vacationDAO-> getParticipants($_GET['id']);
      foreach($participants as $participant){
        if(strpos($participant['description'], "Owner") !== false){
          $owner = $participant['name'];
        }
      }
      $this->set('owner', $owner);

      //set title in the case of character cards
      if(empty($_GET['cardToEdit'])){
        $titleId = $this->cardDAO->getTitleIdByCardIdChar($cardsToEdit[0]['id']);
      }
      else{
        $titleId = $this->cardDAO->getTitleIdByCardIdChar($cardToEdit['id']);
      }
      $cardTitle = $this->cardDAO->getTitleById($titleId['title_id']);
      $this->set('cardTitle', $cardTitle);
    }

    public function handleEdit(){
      if(!empty($_POST['action'])){
        if($_POST['action'] == 'add'){
          $vacationId = $_POST['vacationId']; 
          $cardId = "";
          //cardCount to int to use as parameter
          $cardCountInt = intval($_POST['cardCount']);
          $cardCountInt += 1;
          //cardCount to string to use in header
          $cardCountStr = strval($cardCountInt);
          $cardsFromVacation = $this->vacationDAO->getCardsFromVacation($_POST['vacationId']);
          $i = 0;
          for($i; $i <= count($cardsFromVacation); $i++){
            if($i == $cardCountInt){
              $cardId = strval($cardsFromVacation[$i]['card_id']);
            }
          }

          header('Location: index.php?page=photoEditor&id='.$vacationId.'&cardToEdit='.$cardId.'&cardCount='.$cardCountStr);
        }
      }
    }
}

?>