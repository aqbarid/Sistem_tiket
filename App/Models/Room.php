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
  
}