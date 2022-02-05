<?php

namespace App\Models;


class Room extends Model {

  protected $table = 'rooms';
  protected $primary = 'id';

  public function __construct()
  {
    parent::__construct();
  }

  public function getAll($page = 1, $limit = 12) {
    return $this->runQuery("
    SELECT
    id,
    place_id,
    name,
    description,
    type,
    price_monthly,
    is_available,
    CONCAT('/uploads/', image) AS image,
    price_daily
    FROM rooms
    LIMIT ?
    OFFSET ?
    ",
    [$limit, $page],
    'all');
  }

  public function getBanner() {
    return $this->runQuery("
      SELECT
      id,
      place_id,
      name,
      description,
      type,
      price_monthly,
      is_available,
      CONCAT('/uploads/', image) AS image,
      price_daily
      FROM rooms
      ORDER BY created_at
      LIMIT 5",
      [],
      'all');
  }

  public function createRoom($params) {
    $place = (new Place())->myPlace();
    $this->runQuery('INSERT INTO rooms (place_id, name, description, type, image, price_monthly, price_daily) VALUES (?, ?, ?, ?, ?, ?, ?)', array_merge([$place->id], $params));
  }

  public function myRoom() {
    $user = (new User)->auth();
    return $this->runQuery("
    SELECT
    id,
    place_id,
    name,
    description,
    type,
    price_monthly,
    is_available,
    CONCAT('/uploads/', image) AS image,
    price_daily
    FROM rooms
    WHERE EXISTS(
      SELECT * FROM places WHERE places.user_id = ?
    )
    ", [$user->id], 'all');
  }

  public function getMyRoom($roomId) {
    $user = (new User)->auth();
    return $this->runQuery('
      SELECT rooms.* from rooms
      LEFT JOIN places
      ON places.id = rooms.place_id
      WHERE 
      user_id = ?
      AND rooms.id = ?
    ', [$user->id, $roomId], 'first');
  }


  public function updateRoom(array $arguments) {
    return $this->runQuery('
        UPDATE rooms
        SET name = ?,
        description = ?,
        type = ?,
        image = ?,
        price_monthly = ?,
        price_daily = ?
        WHERE id = ?',
        $arguments
      );
  }

  public function deleteRoom($roomId) {
    return $this->runQuery('
      DELETE FROM rooms WHERE id = ?
    ', [$roomId]);
  }

  public function countAll() {
    return $this->runQuery('SELECT COUNT(*) as count FROM rooms', [], 'first');
  }

  public function getAllAdminRooms($search = '') {
    return $this->runQuery('
      SELECT
      rm.*,
      pl.name as place_name,
      (SELECT COUNT(*) FROM transactions AS tc WHERE tc.room_id = rm.id) total_transaction
      FROM rooms as rm
      INNER JOIN places AS pl
      ON rm.place_id = pl.id
      WHERE rm.name LIKE ?
    ', ["%$search%"], 'all');
  }
  
}