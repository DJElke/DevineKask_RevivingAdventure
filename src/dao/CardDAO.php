<?php

require_once __DIR__ . '/DAO.php';

class CardDAO extends DAO {

  //get card by id
  public function getCardById($id){
    $sql = "SELECT * FROM `Card` 
    WHERE `Card`.`id` = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  //get card and cardImage
  public function getCardAndImage($id){
    $sql = "SELECT `Card`.*, `Picture`.`image` as `img`
    FROM `Card`
    RIGHT JOIN `Picture`
    ON `Picture`.`id` = `Card`.`picture_id`
    WHERE `Card`.`id` = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  //Voor de characterkaarten
  public function getTitleIdByCardIdChar($id){
    $sql = "SELECT `Card`.`title_id`
    FROM `Card`
    WHERE `Card`.`id` = :id;";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function getTitleById($id){
    $sql = "SELECT `Title`.`description` 
    FROM `Title`
    WHERE `Title`.`id` = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

}
?>