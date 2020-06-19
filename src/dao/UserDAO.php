<?php

require_once __DIR__ . '/DAO.php';

class UserDAO extends DAO {
 
  public function getUserName($userid) {
    $sql = "SELECT `Int4_User`.`name` from `Int4_User` WHERE `Int4_User`.`id` = :userid";
    $stmt = $this->pdo->prepare($sql);

    $stmt->execute(array(
      ':userid' => $userid
    ));
    return $stmt->fetch(PDO::FETCH_ASSOC);
  } 
}
?>