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

  public function myTransaction($page=1, $limit=10) {
    $user = (new User())->auth();
      try {
        return $this->runQuery('
        SELECT
        t.*,
        r.name AS room_name,
        p.name AS place_name
        FROM transactions as t
        LEFT JOIN rooms as r
        ON r.id = t.room_id
        LEFT JOIN 
        places as p
        ON p.id = r.place_id
        WHERE customer_id = ?
        ORDER BY updated_at DESC
        ', [$user->id], 'all');
      } catch(Exception $e) {
        return new stdClass;
      }
  }

  public function totalMyTransaction($page=1, $limit=10) {
    $user = (new User())->auth();
      try {
        return $this->runQuery('
        SELECT
        COUNT(*) as count
        FROM transactions
        WHERE customer_id = ?
        ', [$user->id], 'first');
      } catch(Exception $e) {
        return new stdClass;
      }
  }

  public function myLastTransaction($page=1, $limit=10) {
    $user = (new User())->auth();
      try {
        return $this->runQuery('
        SELECT
        t.*,
        r.name AS room_name,
        p.name AS place_name
        FROM transactions as t
        LEFT JOIN rooms as r
        ON r.id = t.room_id
        LEFT JOIN 
        places as p
        ON p.id = r.place_id
        WHERE customer_id = ?
        ORDER BY updated_at DESC
        LIMIT 10
        ', [$user->id], 'all');
      } catch(Exception $e) {
        return new stdClass;
      }
  }

  public function getOutCome() {
    $user = (new User())->auth();
    // return $this->runQuery('SELECT COUNT(*) as total ')
  }

  public function getAllTransactions() {
    return $this->runQuery('
      SELECT
      t.*,
      r.name AS room_name,
      p.name AS place_name,
      u.name AS customer_name,
      ad.name AS admin_name
      FROM transactions as t
      LEFT JOIN rooms as r
      ON r.id = t.room_id
      LEFT JOIN 
      places as p
      ON p.id = r.place_id
      LEFT JOIN
      users AS u
      on t.customer_id = u.id 
      LEFT JOIN
      users AS ad
      ON ad.id = t.admin_id
      ORDER BY updated_at DESC
    ', [], 'all');
  }

  public function detailTransaction($id) {
    return $this->runQuery('
      SELECT
      t.*,
      pay.*,
      r.name AS room_name,
      r.id AS room_id,
      p.name AS place_name,
      p.id AS place_id,
      u.name AS customer_name,
      ad.name AS admin_name
      FROM transactions as t
      LEFT JOIN rooms as r
      ON r.id = t.room_id
      LEFT JOIN 
      places as p
      ON p.id = r.place_id
      LEFT JOIN
      users AS u
      on t.customer_id = u.id 
      LEFT JOIN
      users AS ad
      ON ad.id = t.admin_id
      LEFT JOIN payments as pay
      ON pay.transaction_id = t.id
      WHERE t.id = ?
    ', [$id], 'first');
  }

  public function totalAllTransaction($page=1, $limit=10) {
      try {
        return $this->runQuery('
        SELECT
        COUNT(*) as count
        FROM transactions
        ', [], 'first');
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
    return $this->runQuery('SELECT * FROM transactions WHERE id = ? AND (status = "pending" OR status = "checking")', [$id], 'first');
  }

  public function myTransactionByStatus($status = 'pending') {
    $user = (new User())->auth();
      try {
        return $this->runQuery('
        SELECT
        t.*,
        r.name AS room_name,
        p.name AS place_name
        FROM transactions as t
        INNER JOIN rooms as r
        ON r.id = t.room_id
        LEFT JOIN 
        places as p
        ON p.id = r.place_id
        WHERE customer_id = ?
        AND status = ?
        ORDER BY updated_at DESC
        ', [$user->id, $status], 'all');
      } catch(Exception $e) {
        return new stdClass;
      }
  }

  public function setStatus($id, $status = 'checking') {
    return $this->runQuery("UPDATE transactions SET status = ? WHERE id = ?", [$status, $id]);
  }

  public function countTotalIncome() {
    return $this->runQuery('SELECT SUM(total) as income FROM transactions WHERE status = "success"', [], 'first');
  }

  public function countTotalWaiting() {
    return $this->runQuery('SELECT COUNT(*) as count FROM transactions WHERE status = "checking"', [], 'first');
  }
}