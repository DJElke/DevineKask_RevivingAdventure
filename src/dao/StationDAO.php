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

          $sql = "INSERT INTO `Int4_Card` (`cardtype_id`) VALUES (:cardtype_id);";
          $stmt = $this->pdo->prepare($sql);
          $stmt->execute(array(
              ':cardtype_id' => 1      
            )
          );
          
          $cardID = $this->pdo->lastInsertId();

          $sql = "INSERT INTO `Int4_Title` (`description`) VALUES (:title_description);";
          $stmt = $this->pdo->prepare($sql);
          $stmt->execute(array(
              ':title_description' => $card['title']      
            )
          );

          $titleID = $this->pdo->lastInsertId();

          //update Int4_Card
          // $sql = "INSERT INTO `Int4_Card` (`id'`,`title_id`) VALUES (:id,:title_id);";
          // $stmt = $this->pdo->prepare($sql);
          // $stmt->execute(array(
          //     ':id' => $cardId,
          //     ':title_id' => $titleID      
          //   )
          // );
          $sql = "UPDATE `Int4_Card` SET `title_id` = :title_id
          WHERE `id`= :id";
          $stmt = $this->pdo->prepare($sql);
          $stmt->execute(array(
                ':id' => $cardID,
                ':title_id' => $titleID      
              )
          );

          $sql = "INSERT INTO `Int4_Picture` (`image`) VALUES (:image);";
          $stmt = $this->pdo->prepare($sql);
          $stmt->execute(array(
              ':image' => $card['image']      
            )
          );

          $pictureID = $this->pdo->lastInsertId();

          $sql = "INSERT INTO `Int4_Card_Picture` (`card_id`, `picture_id`) VALUES (:card_id, :picture_id);";
          $stmt = $this->pdo->prepare($sql);
          $stmt->execute(array(
              ':card_id' => $cardID,
              ':picture_id' => $pictureID      
            )
          );

          $sql = "INSERT INTO `Int4_Vacation_Card` (`card_id`, `vacation_id`) VALUES (:card_id, :vacation_id);";
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
    return false;
  }

  public function insertItemCard($cards) {
    $errors = $this->validate( $cards );
    if (empty($errors)) {
      try {
        $this->pdo->beginTransaction();

        foreach ($cards as $card){

          $sql = "INSERT INTO `Int4_Card` (`cardtype_id`) VALUES (:cardtype_id);";
          $stmt = $this->pdo->prepare($sql);
          $stmt->execute(array(
              ':cardtype_id' => 2      
            )
          );
          
          $cardID = $this->pdo->lastInsertId();

          $sql = "INSERT INTO `Int4_Picture` (`image`) VALUES (:image);";
          $stmt = $this->pdo->prepare($sql);
          $stmt->execute(array(
              ':image' => $card['image']      
            )
          );

          $pictureID = $this->pdo->lastInsertId();

          $sql = "INSERT INTO `Int4_Card_Picture` (`card_id`, `picture_id`) VALUES (:card_id, :picture_id);";
          $stmt = $this->pdo->prepare($sql);
          $stmt->execute(array(
              ':card_id' => $cardID,
              ':picture_id' => $pictureID      
            )
          );

          $sql = "INSERT INTO `Int4_Vacation_Card` (`card_id`, `vacation_id`) VALUES (:card_id, :vacation_id);";
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
    return false;
  }


  public function insertAdventureCard($cards) {
    $errors = $this->validate( $cards );
    if (empty($errors)) {
      try {
        $this->pdo->beginTransaction();

        foreach ($cards as $card){

          $sql = "INSERT INTO `Int4_Card` (`cardtype_id`) VALUES (:cardtype_id);";
          $stmt = $this->pdo->prepare($sql);
          $stmt->execute(array(
              ':cardtype_id' => 3      
            )
          );
          
          $cardID = $this->pdo->lastInsertId();

          $sql = "INSERT INTO `Int4_Picture` (`image`) VALUES (:image);";
          $stmt = $this->pdo->prepare($sql);
          $stmt->execute(array(
              ':image' => $card['image']      
            )
          );

          $pictureID = $this->pdo->lastInsertId();

          $sql = "INSERT INTO `Int4_Card_Picture` (`card_id`, `picture_id`) VALUES (:card_id, :picture_id);";
          $stmt = $this->pdo->prepare($sql);
          $stmt->execute(array(
              ':card_id' => $cardID,
              ':picture_id' => $pictureID      
            )
          );

          $sql = "INSERT INTO `Int4_Vacation_Card` (`card_id`, `vacation_id`) VALUES (:card_id, :vacation_id);";
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
     $errors = [];
     $i = 0;
     foreach($cards as $card){
      if (strlen($card['image']) == 0) {
        $errors[$i]['image'] = 'Please select an image';
      }
      if (isset($card['title']) && strlen($card['title']) == 0) {
        $errors[$i]['title'] = 'Please select a characteristic';
      }
      $i++;
     }
     unset($i);
      return $errors;
  }

  public function updateStatus($vac_id, $user_id){
    $sql = "UPDATE `Int4_Vacation_User` SET status = status + 1 WHERE user_id = :user_id AND vacation_id = :vacation_id ;";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(array(
        ':user_id' => $user_id,
        ':vacation_id' => $vac_id
      )
    );
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  //get `Int4_Vacation_User` id by filtering on user_id and vacation_id
  public function getVacUserByUserIdAndVacId($userid, $vacationid){
    $sql = "SELECT * FROM `Int4_Vacation_User` WHERE user_id = :userid AND vacation_id = :vacationid";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(array(
            ':userid' => $userid,
            ':vacationid' => $vacationid
    ));
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

}
?>