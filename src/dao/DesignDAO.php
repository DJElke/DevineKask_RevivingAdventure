<?php

require_once __DIR__ . '/DAO.php';

class DesignDAO extends DAO {
 
  //get the name of a vacation
  public function getDesigns() {

    $sql = "SELECT `Int4_Design`.`id`, `Int4_Design`.`description`, `Int4_Design`.`lucky_cards`, `Int4_Design`.`hazard_cards` FROM `Int4_Design`";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);

  }

  public function registerVote($loggedInUser, $designId) {

    $sql = "UPDATE `Int4_Vacation_User` SET `design_id` = :design_id WHERE `Int4_Vacation_User`.`user_id` = :user_id";
          $stmt = $this->pdo->prepare($sql);
          $stmt->execute(array(
              ':design_id' => $designId,
              ':user_id' => $loggedInUser
            )
          );
  }
}
?>