<?php

namespace App\Traits;

use Exception;
use PDO;

trait ModelTraits {
  public function findBy($column, $value) {
    try {
      $table = $this->table;
      $stm = $this->db->prepare("SELECT * FROM $table WHERE $column = ?");
      $stm->execute([$value]);
      return $stm->fetch(PDO::FETCH_OBJ);
    } catch(Exception $e) {
      return null;
    }
  }

  public function whereBy($column, $value) {
    try {
      $table = $this->table;
      $stm = $this->db->prepare("SELECT * FROM $table WHERE $column = ?");
      $stm->execute([$value]);
      return $stm->fetchAll(PDO::FETCH_OBJ);
    } catch(Exception $e) {
      return null;
    }
  }

  public function findById($value) {
    $column = $this->primary;
    return $this->findBy($column, $value);
  }

}