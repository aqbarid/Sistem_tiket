<?php

namespace App\Drivers;
use PDO;

class Database {

  public $db;


  public function __construct()
  {
    $host = $_ENV['DB_HOST'];
    $port =  $_ENV['DB_PORT'];
    $database = $_ENV['DB_NAME'];

    $option = [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::ATTR_EMULATE_PREPARES => false
    ];

    $this->db = new PDO("mysql:host=$host;port=$port;dbname=$database", $_ENV['DB_USER'], $_ENV['DB_PASSWORD'], $option);
  }
}