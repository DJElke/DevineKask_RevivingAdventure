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

  //get the image url by id
  public function getImageUrlById($id){
    $sql = "SELECT `image`
    FROM `Int4_Picture`
    WHERE `Int4_Picture`.`id` = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  //Get the title id of character cars with the id of the card
  public function getTitleIdByCardIdChar($id){
    $sql = "SELECT `Int4_Card`.`title_id`
    FROM `Int4_Card`
    WHERE `Int4_Card`.`id` = :id;";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

    //get title by id
    public function getTitleById($id){
      $sql = "SELECT *
      FROM `Int4_Title`
      WHERE `Int4_Title`.`id` = :id";
      $stmt = $this->pdo->prepare($sql);
      $stmt->bindValue(':id', $id);
      $stmt->execute();
      return $stmt->fetch(PDO::FETCH_ASSOC);
    }

  //get title description by id
  public function getTitleDescriptionById($id){
    $sql = "SELECT `Int4_Title`.`description` 
    FROM `Int4_Title`
    WHERE `Int4_Title`.`id` = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  //add title to Int4_Title
  public function insertTitle($data){
    $sql = "INSERT INTO `Int4_Title` (`description`) VALUES (:description)";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':description', $data);
    if ($stmt->execute()) {
      return $this->getTitleById($this->pdo->lastInsertId());
    }
  }

  //connect card and the new inserted title in Int4_Card_Title
  public function insertCardTitle($cardId, $titleId){
    $sql = "INSERT INTO `Int4_Card_Title` (`card_id`,`title_id`) VALUES (:card_id, :title_id)";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':card_id', $cardId);
    $stmt->bindValue(':title_id', $titleId['id']);
    $stmt->execute();
  }

  //get description by id
  public function getDescriptionById($id){
    $sql = "SELECT *
    FROM `Int4_Description`
    WHERE `Int4_Description`.`id` = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  //add description to Int4_Description
  public function insertDescription($data){
    $sql = "INSERT INTO `Int4_Description` (`description`) VALUES (:description)";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':description', $data);
    if ($stmt->execute()) {
      return $this->getDescriptionById($this->pdo->lastInsertId());
    }
  }

    //connect card and the new inserted description in Int4_Card_Description
    public function insertCardDescription($cardId, $descriptionId){
      $sql = "INSERT INTO `Int4_Card_Description` (`card_id`,`description_id`) VALUES (:card_id, :description_id)";
      $stmt = $this->pdo->prepare($sql);
      $stmt->bindValue(':card_id', $cardId);
      $stmt->bindValue(':description_id', $descriptionId['id']);
      $stmt->execute();
    }

  //get image by id
  public function getImageById($id){
    $sql = "SELECT *
    FROM `Int4_Picture`
    WHERE `Int4_Picture`.`id` = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  //add image to Int4_Picture
  public function insertImage($data){
    $sql = "INSERT INTO `Int4_Picture` (`image`) VALUES (:image)";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':image', $data);
    if ($stmt->execute()) {
      return $this->getImageById($this->pdo->lastInsertId());
    }
  }

  //conncect card and the new inserted description in Int4_Card_Description
    public function insertCardPicture($cardId, $pictureId){
      $sql = "INSERT INTO `Int4_Card_Picture` (`card_id`,`picture_id`) VALUES (:card_id, :picture_id)";
      $stmt = $this->pdo->prepare($sql);
      $stmt->bindValue(':card_id', $cardId);
      $stmt->bindValue(':picture_id', $pictureId['id']);
      $stmt->execute();
    }
}
?>