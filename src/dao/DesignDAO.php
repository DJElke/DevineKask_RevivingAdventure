<?php

require_once __DIR__ . '/DAO.php';

class DesignDAO extends DAO {
 
  //get the name of a vacation
  public function getDesigns() {

    $sql = "SELECT Design.id, Design.description, Design.lucky_cards, Design.hazard_cards FROM Design";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);

  }

  public function registerVote($loggedInUser, $designId) {

    $sql = "UPDATE `Vacation_User` SET `design_id` = :design_id WHERE Vacation_User.user_id = :user_id";
          $stmt = $this->pdo->prepare($sql);
          $stmt->execute(array(
              ':design_id' => $designId,
              ':user_id' => $loggedInUser
            )
          );
  }
}
?>