<?php

require_once __DIR__ . '/DAO.php';

class VacationDAO extends DAO {
 
  //get the vacation by id
  public function getVacationById($id){
    $sql = "SELECT * FROM Vacation 
    WHERE Vacation.id = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }


  //get the name of a vacation
  public function getVacationName($vacationId) {
    $sql = "SELECT Vacation.id, Vacation.name FROM Vacation WHERE Vacation.id = :vacationId";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(array(
      ':vacationId' => $vacationId
    ));
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }
  
  //get the participants (name and role) for a vacation
  public function getParticipants($vacationId) {
    $sql = "SELECT Vacation_User.user_id as 'id', User.name, UserRole.description, User.picture as 'icon' 
    FROM Vacation_User JOIN User ON Vacation_User.user_id = User.id 
    JOIN UserRole ON Vacation_User.userrole_id = UserRole.id 
    WHERE Vacation_User.vacation_id = :vacationId";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(array(
      ':vacationId' => $vacationId
    ));
    return $stmt->fetchAll(PDO::FETCH_ASSOC);   
  }

  public function getStatus($vacationId, $userId) {
    $sql = "SELECT Vacation_User.status 
    FROM Vacation_User 
    WHERE Vacation_User.vacation_id = :vacationId 
    AND Vacation_User.user_id = :userId";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(array(
      ':vacationId' => $vacationId,
      ':userId' => $userId
    ));
    return $stmt->fetch(PDO::FETCH_ASSOC); 
  }

  //get cards from a vacation 
  public function getCardsFromVacation($id){
    $sql = "SELECT *
    FROM Vacation_Card
    WHERE Vacation_Card.vacation_id = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}
?>