<?php

namespace App\Models;

use Exception;
use stdClass;

class Transaction extends Model {

  protected $table = 'transactions';
  protected $primary = 'id';

  public function __construct()
  {
    parent::__construct();
  }
  
  /**
   * Fields
   * - customer_id
   * - admin_id
   * - room_id
   * - seller_id
   * - status
   * - days
   * - months
   * - expired_at
   */

  public function myTransaction() {
    $user = (new User())->auth();
      try {
        return $this->whereBy('customer_id', $user->id);
      } catch(Exception $e) {
        return new stdClass;
      }
  }

  public function createTransaction($arguments) {
    $this->runQuery('
    INSERT INTO transactions (customer_id, room_id, status, total, days, months) VALUES(?, ?, ?, ?, ?, ?);
    ', $arguments);
    return $this->runQuery('SELECT * FROM transactions WHERE id = LAST_INSERT_ID()', [], 'first');
  }

  public function findIsPending($id) {
    return $this->runQuery('SELECT * FROM transactions WHERE id = ? AND status = "pending"', [$id], 'first');
  }
}