<?php

require_once __DIR__ . '/DAO.php';

class HomeDAO extends DAO {
 
  public function getUserName($userid) {
    $sql = "SELECT `Int4_User`.`name` from `Int4_User` WHERE `Int4_User`.`id` = :userid";
    $stmt = $this->pdo->prepare($sql);

    $stmt->execute(array(
      ':userid' => $userid
    ));
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function getOwnedVacations($userid) {
    $sql = "SELECT `Int4_Vacation`.`id`, `Int4_Vacation`.`name`, `Int4_Vacation_User`.`status` FROM `Int4_Vacation` 
    JOIN `Int4_Vacation_User` on `Int4_Vacation`.`id` = `Int4_Vacation_User`.`vacation_id`
    JOIN `Int4_User` on `Int4_Vacation_User`.`user_id` = `Int4_User`.`id`
    JOIN `Int4_UserRole` ON `Int4_UserRole`.`id` = `Int4_Vacation_User`.`userrole_id`
    WHERE `Int4_User`.`id` = :userid
    AND `Int4_UserRole`.`description` = 'owner'";
    $stmt = $this->pdo->prepare($sql);

    $stmt->execute(array(
      ':userid' => $userid
    ));
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getInvolvedVacations($userid) {
    $sql = "SELECT `Int4_Vacation`.`id`, `Int4_Vacation`.`name`, `Int4_Vacation_User`.`status` FROM `Int4_Vacation` 
    JOIN `Int4_Vacation_User` on `Int4_Vacation`.`id` = `Int4_Vacation_User`.`vacation_id`
    JOIN `Int4_User` on `Int4_Vacation_User`.`user_id` = `Int4_User`.`id`
    JOIN `Int4_UserRole` ON `Int4_UserRole`.`id` = `Int4_Vacation_User`.`userrole_id`
    WHERE `Int4_User`.`id` = :userid
    AND `Int4_UserRole`.`description` = 'editor'";
    $stmt = $this->pdo->prepare($sql);

    $stmt->execute(array(
      ':userid' => $userid
    ));
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}
?>