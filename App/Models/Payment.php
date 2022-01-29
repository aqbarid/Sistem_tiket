<?php

namespace App\Models;

use Exception;

class Payment extends Model {

  protected $table = 'payments';
  protected $primary = 'id';

  public function __construct()
  {
    parent::__construct();
  }
  
  /**
   * Fields
   * - transaction_id
   * - bank
   * - account_name
   * - account_number
   * - total
   * - valid
   * - file
   */

  public function createPayment($arguments) {
    return $this->runQuery('
      INSERT INTO payments (transaction_id, bank, account_name, account_number, total, file) VALUES(?, ?, ?, ?, ?, ?);
      ', $arguments, 'first');
  }
}