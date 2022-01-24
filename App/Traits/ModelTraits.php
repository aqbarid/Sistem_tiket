<?php

namespace App\Traits;

use PDO;

trait ModelTraits {
  public function findBy($column, $value) {
    $table = $this->table;
    $stm = $this->db->prepare("SELECT * FROM $table WHERE $column = ?");
    $stm->execute([$value]);
    return $stm->fetch(PDO::FETCH_OBJ);
  }


  public function findById($value) {
    $column = $this->primary;
    return $this->findBy($column, $value);
  }

}