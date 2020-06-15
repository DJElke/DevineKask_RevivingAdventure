<?php

require_once __DIR__ . '/DAO.php';

class StationDAO extends DAO {
 
  public function insertCharacterCard($data) {
    
    try {
      $this->pdo->beginTransaction();

      $sql = "INSERT INTO Card (cardtype_id) VALUES (:cardtype_id)";
      $stmt = $this->pdo->prepare($sql);
      $stmt->execute(array(
          ":cardtype_id" => 1
        )
      );

      $sql = "hier komt statement1";
      $stmt = $this->pdo->prepare($sql);
      $stmt->execute(array(
          "hier komen parameters"
      
        )
      );

      $sql = "hier komt statement1";
      $stmt = $this->pdo->prepare($sql);
      $stmt->execute(array(
          "hier komen parameters"
      
        )
      );

      $sql = "hier komt statement1";
      $stmt = $this->pdo->prepare($sql);
      $stmt->execute(array(
          "hier komen parameters"
      
        )
      );

      $sql = "hier komt statement1";
      $stmt = $this->pdo->prepare($sql);
      $stmt->execute(array(
          "hier komen parameters"
      
        )
      );

      $sql = "hier komt statement1";
      $stmt = $this->pdo->prepare($sql);
      $stmt->execute(array(
          "hier komen parameters"
      
        )
      );


    } catch (Exception $e) {
        echo $e-> getMessage();
        $this->pdo->rollback();
    }
  }
   
}
?>