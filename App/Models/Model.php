<?php 
namespace App\Models;

use App\Traits\ModelTraits;
use App\Drivers\Database;
use PDO;

class Model extends Database {
  use ModelTraits;
  
  public function __construct()
  {
    parent::__construct();
  }

  public function query($query, $params, $fetch=null) {
    $stm = $this->db->parepare($query);
    $stm->execute($params);
    if($fetch == 'all') {
      return $stm->fetch(PDO::FETCH_OBJ);
    } else if($fetch == 'first') {
      return $stm->fetch();
    }
  }


}