<?php

namespace App\Models;

use Exception;
use stdClass;

class Place extends Model {

  protected $table = 'places';
  protected $primary = 'id';

  public function __construct()
  {
    parent::__construct();
  }

  public function myPlace() {

    $user = (new User())->auth();

      try {
        return $this->findBy('user_id', $user->id);
      } catch(Exception $e) {
        return new stdClass;
      }
  }

  public function getBanners($placeid) {
    return $this->runQuery("
    SELECT
    CONCAT('/uploads/', image) AS image
    FROM rooms
    JOIN places
      ON places.id = rooms.place_id
    WHERE places.id = ?
    LIMIT 5 ", [$placeid], 'all');
  }

  public function storeOrUpdate($name, $address, $contact, $description) {
    $user = (new User())->auth();

    $storeId = null;
    try {
      $myStore = $this->findBy('user_id', $user->id);
      $storeId = isset($myStore->id) ? $myStore->id : null;
    } catch(\Exception $e) {
      //
    }
    if($storeId) {
      $this->runQuery('UPDATE places SET name = ?, address = ?, contact = ?, description = ? WHERE id = ?',
                    [$name, $address, $contact, $description, $storeId]
                  );
    } else {
      $this->runQuery('INSERT INTO places(user_id, name, address, contact, description) VALUES(?, ?, ?, ?, ?)',
                      [$user->id, $name, $address, $contact, $description]
                    );
    }
  }

  public function totalPlace() {
    return $this->runQuery('SELECT COUNT(*) as count FROM places', [], 'first');
  }

  public function getAll(String $search = '') {
    return $this->runQuery('
      SELECT
      p.*,
      u.name as user_name,
      (SELECT COUNT(*) FROM rooms AS rm WHERE rm.place_id = p.id) AS total_room,
      (
        SELECT COUNT(*) FROM transactions as tc
        JOIN rooms as rm
        ON rm.id = tc.room_id
        WHERE rm.place_id = p.id
      ) AS total_transaction,
      (
        SELECT SUM(total) FROM transactions as tc
        JOIN rooms as rm
        ON rm.id = tc.room_id
        WHERE rm.place_id = p.id
        AND tc.status = "success"
      ) AS total_income
      FROM places AS p
      INNER JOIN users AS u
      ON u.id = p.user_id
      WHERE
      p.name LIKE ?
      ORDER BY total_transaction
      ', ["%$search%"], 'all');
  }

}
