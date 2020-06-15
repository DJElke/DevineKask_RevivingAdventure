<?php

require_once __DIR__ . '/DAO.php';

class UserDAO extends DAO {
 
  public function getUserName($userid) {
    $sql = "SELECT User.name from USER WHERE User.id = :userid";
    $stmt = $this->pdo->prepare($sql);

    $stmt->execute(array(
      ':userid' => $userid
    ));
    return $stmt->fetch(PDO::FETCH_ASSOC);
  } 
}
?>