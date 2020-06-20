<?php

require_once __DIR__ . '/DAO.php';

class CardDAO extends DAO {

  //get card by id
  public function getCardById($id){
    $sql = "SELECT * FROM `Int4_Card` 
    WHERE `Int4_Card`.`id` = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  //get picture id by cardId
  public function getPictureIdsByCardId($id){
    $sql = "SELECT `picture_id` 
    FROM `Int4_Card_Picture`
    WHERE `Int4_Card_Picture`.`card_id` = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getImageById($id){
    $sql = "SELECT `image`
    FROM `Int4_Picture`
    WHERE `Int4_Picture`.`id` = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  //Voor de characterkaarten
  public function getTitleIdByCardIdChar($id){
    $sql = "SELECT `Int4_Card`.`title_id`
    FROM `Int4_Card`
    WHERE `Int4_Card`.`id` = :id;";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function getTitleById($id){
    $sql = "SELECT `Int4_Title`.`description` 
    FROM `Int4_Title`
    WHERE `Int4_Title`.`id` = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

}
?>