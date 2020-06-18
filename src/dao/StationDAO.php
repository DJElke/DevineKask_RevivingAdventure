<?php

require_once __DIR__ . '/DAO.php';

class StationDAO extends DAO {
 
  public function insertCharacterCard($cards) {
    $errors = $this->validate( $cards );
    // $cardTypeId = $_GET['cardTypeId'];
    if (empty($errors)) {
      try {
        $this->pdo->beginTransaction();

        foreach ($cards as $card){

          $sql = "INSERT INTO `Card` (`cardtype_id`) VALUES (:cardtype_id);";
          $stmt = $this->pdo->prepare($sql);
          $stmt->execute(array(
              ':cardtype_id' => $cardTypeId      
            )
          );
          
          $cardID = $this->pdo->lastInsertId();

          $sql = "INSERT INTO `Title` (`description`) VALUES (:title_description);";
          $stmt = $this->pdo->prepare($sql);
          $stmt->execute(array(
              ':title_description' => $card['title']      
            )
          );

          $titleID = $this->pdo->lastInsertId();

          $sql = "INSERT INTO `Card_Title` (`card_id`, `title_id`) VALUES (:card_id, :title_id);";
          $stmt = $this->pdo->prepare($sql);
          $stmt->execute(array(
              ':card_id' => $cardID,
              ':title_id' => $titleID      
            )
          );

          $sql = "INSERT INTO `Picture` (`image`) VALUES (:image);";
          $stmt = $this->pdo->prepare($sql);
          $stmt->execute(array(
              ':image' => $card['image']      
            )
          );

          $pictureID = $this->pdo->lastInsertId();

          $sql = "INSERT INTO `Card_Picture` (`card_id`, `picture_id`) VALUES (:card_id, :picture_id);";
          $stmt = $this->pdo->prepare($sql);
          $stmt->execute(array(
              ':card_id' => $cardID,
              ':picture_id' => $pictureID      
            )
          );

          $sql = "INSERT INTO `Vacation_Card` (`card_id`, `vacation_id`) VALUES (:card_id, :vacation_id);";
          $stmt = $this->pdo->prepare($sql);
          $stmt->execute(array(
              ':card_id' => $cardID,
              ':vacation_id' => $card['vacation_id']
            )
          );

          unset($cardID);
          unset($pictureID);
          unset($titleID);
        }
        $this->pdo->commit();
        return true;

      } catch (Exception $e) {
          echo $e-> getMessage();
          $this->pdo->rollback();
          return false;
        }
    }
  }

  public function insertItemCard($cards) {
    $errors = $this->validate( $cards );
    if (empty($errors)) {
      try {
        $this->pdo->beginTransaction();

        foreach ($cards as $card){

          $sql = "INSERT INTO `Card` (`cardtype_id`) VALUES (:cardtype_id);";
          $stmt = $this->pdo->prepare($sql);
          $stmt->execute(array(
              ':cardtype_id' => 2      
            )
          );
          
          $cardID = $this->pdo->lastInsertId();

          $sql = "INSERT INTO `Picture` (`image`) VALUES (:image);";
          $stmt = $this->pdo->prepare($sql);
          $stmt->execute(array(
              ':image' => $card['image']      
            )
          );

          $pictureID = $this->pdo->lastInsertId();

          $sql = "INSERT INTO `Card_Picture` (`card_id`, `picture_id`) VALUES (:card_id, :picture_id);";
          $stmt = $this->pdo->prepare($sql);
          $stmt->execute(array(
              ':card_id' => $cardID,
              ':picture_id' => $pictureID      
            )
          );

          $sql = "INSERT INTO `Vacation_Card` (`card_id`, `vacation_id`) VALUES (:card_id, :vacation_id);";
          $stmt = $this->pdo->prepare($sql);
          $stmt->execute(array(
              ':card_id' => $cardID,
              ':vacation_id' => $card['vacation_id']
            )
          );

          unset($cardID);
          unset($pictureID);
        }
        $this->pdo->commit();
        return true;

      } catch (Exception $e) {
          echo $e-> getMessage();
          $this->pdo->rollback();
          return false;
        }
    }
  }


  public function insertAdventureCard($cards) {
    $errors = $this->validate( $cards );
    if (empty($errors)) {
      try {
        $this->pdo->beginTransaction();

        foreach ($cards as $card){

          $sql = "INSERT INTO `Card` (`cardtype_id`) VALUES (:cardtype_id);";
          $stmt = $this->pdo->prepare($sql);
          $stmt->execute(array(
              ':cardtype_id' => 3      
            )
          );
          
          $cardID = $this->pdo->lastInsertId();

          $sql = "INSERT INTO `Picture` (`image`) VALUES (:image);";
          $stmt = $this->pdo->prepare($sql);
          $stmt->execute(array(
              ':image' => $card['image']      
            )
          );

          $pictureID = $this->pdo->lastInsertId();

          $sql = "INSERT INTO `Card_Picture` (`card_id`, `picture_id`) VALUES (:card_id, :picture_id);";
          $stmt = $this->pdo->prepare($sql);
          $stmt->execute(array(
              ':card_id' => $cardID,
              ':picture_id' => $pictureID      
            )
          );

          $sql = "INSERT INTO `Vacation_Card` (`card_id`, `vacation_id`) VALUES (:card_id, :vacation_id);";
          $stmt = $this->pdo->prepare($sql);
          $stmt->execute(array(
              ':card_id' => $cardID,
              ':vacation_id' => $card['vacation_id']
            )
          );

          unset($cardID);
          unset($pictureID);
        }
        $this->pdo->commit();
        return true;

      } catch (Exception $e) {
          echo $e-> getMessage();
          $this->pdo->rollback();
          return false;
        }
    }
  }

  public function validate( $cards ){
    // $errors = [];
    // if (!isset($data['voornaam'])) {
    //   $errors['voornaam'] = 'Gelieve in te vullen';
    // }
    // if (empty($data['achternaam']) ){
    //   $errors['achternaam'] = 'Gelieve in te vullen';
    // }
    // if (!isset($data['email'])) {
    //   $errors['email'] = 'Gelieve in te vullen';
    // }
    // return $errors;
  }

  public function updateStatus($vac_id, $user_id){
    $sql = "UPDATE `Vacation_User` SET status = status + 1 WHERE user_id = :user_id AND vacation_id = :vacation_id ;";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(array(
        ':user_id' => $user_id,
        ':vacation_id' => $vac_id
      )
    );
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }
}
?>