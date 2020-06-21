<?php

require_once __DIR__ . '/DAO.php';

class StickersDAO extends DAO {
 
  public function getStickerImages() {
    $sql = "SELECT *
    FROM `Int4_Stickers`";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  } 
}
?>