<?php

require_once __DIR__ . '/DAO.php';

class HomeDAO extends DAO {
 
  public function getUserName($userid) {
    $sql = "SELECT User.name from USER WHERE User.id = :userid";
    $stmt = $this->pdo->prepare($sql);

    $stmt->execute(array(
      ':userid' => $userid
    ));
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function getOwnedVacations($userid) {
    $sql = "SELECT Vacation.id, Vacation.name, Vacation_User.status FROM Vacation 
    JOIN Vacation_User on Vacation.id = Vacation_User.vacation_id
    JOIN User on Vacation_User.user_id = User.id
    JOIN UserRole ON UserRole.id = Vacation_User.userrole_id
    WHERE User.id = :userid
    AND UserRole.description = 'owner'";
    $stmt = $this->pdo->prepare($sql);

    $stmt->execute(array(
      ':userid' => $userid
    ));
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getInvolvedVacations($userid){
    $sql = "SELECT Vacation.id, Vacation.name, Vacation_User.status FROM Vacation 
    JOIN Vacation_User on Vacation.id = Vacation_User.vacation_id
    JOIN User on Vacation_User.user_id = User.id
    JOIN UserRole ON UserRole.id = Vacation_User.userrole_id
    WHERE User.id = :userid
    AND UserRole.description = 'editor'";
    $stmt = $this->pdo->prepare($sql);

    $stmt->execute(array(
      ':userid' => $userid
    ));
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}
?>