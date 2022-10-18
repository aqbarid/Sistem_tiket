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
    $this->runQuery('
      INSERT INTO payments (transaction_id, bank, account_name, account_number, total, file) VALUES(?, ?, ?, ?, ?, ?);
      ', $arguments, 'first');    
  }
  public function paymentDetails($id) {
    return $this->runQuery('
    SELECT p.*, 
    t.status AS status, 
    t.id AS id FROM payments as p LEFT JOIN transactions as t ON t.id = p.transaction_id WHERE p.transaction_id = ?
    ', [$id], 'first');
  }
}