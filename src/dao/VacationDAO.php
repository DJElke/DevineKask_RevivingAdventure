<?php

require_once __DIR__ . '/DAO.php';

class VacationDAO extends DAO {
 
  //get the vacation by id
  public function getVacationById($id){
    $sql = "SELECT * FROM `Int4_Vacation` 
    WHERE `Int4_Vacation`.`id` = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }


  //get the name of a vacation
  public function getVacationName($vacationId) {
    $sql = "SELECT `Int4_Vacation`.`id`, `Int4_Vacation`.`name` FROM `Int4_Vacation` WHERE `Int4_Vacation`.`id` = :vacationId";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(array(
      ':vacationId' => $vacationId
    ));
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }
  
  //get the participants (name and role) for a vacation
  public function getParticipants($vacationId) {
    $sql = "SELECT `Int4_Vacation_User`.`user_id` as 'id', `Int4_User`.`name`, `Int4_UserRole`.`description`, `Int4_User`.`picture` as 'icon' 
    FROM `Int4_Vacation_User` JOIN `Int4_User` ON `Int4_Vacation_User`.`user_id` = `Int4_User`.`id`
    JOIN `Int4_UserRole` ON `Int4_Vacation_User`.`userrole_id` = `Int4_UserRole`.`id` 
    WHERE `Int4_Vacation_User`.`vacation_id` = :vacationId";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(array(
      ':vacationId' => $vacationId
    ));
    return $stmt->fetchAll(PDO::FETCH_ASSOC);   
  }

  public function getStatus($vacationId, $userId) {
    $sql = "SELECT `Int4_Vacation_User`.`status` 
    FROM `Int4_Vacation_User` 
    WHERE `Int4_Vacation_User`.`vacation_id` = :vacationId 
    AND `Int4_Vacation_User`.`user_id` = :userId";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(array(
      ':vacationId' => $vacationId,
      ':userId' => $userId
    ));
    return $stmt->fetch(PDO::FETCH_ASSOC); 
  }

  //get cards from a vacation 
  public function getCardsFromVacation($id, $cardType){
    $sql = "SELECT `Int4_Vacation_Card`.*, `Int4_Card`.`cardtype_id` as `cardtype`
    FROM `Int4_Vacation_Card`
    JOIN `Int4_Card` ON `Int4_Vacation_Card`.`card_id` = `Int4_Card`.`id`
    WHERE `Int4_Vacation_Card`.`vacation_id` = :id
    HAVING `cardtype` = :cardType";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->bindValue(':cardType', $cardType);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}
?>