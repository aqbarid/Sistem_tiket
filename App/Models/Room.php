<?php

namespace App\Models;

use Exception;
use stdClass;

class Room extends Model {

  protected $table = 'rooms';
  protected $primary = 'id';

  public function __construct()
  {
    parent::__construct();
  }

  public function createRoom($params) {
    $stm = $this->runQuery('INSERT INTO rooms (place_id, name, description, type, price_monthly, price_daily, is_available) VALUES (?, ?, ?, ?, ?, ?)');
    $stm->execute($params);
  }
  
}