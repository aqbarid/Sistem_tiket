<?php
namespace App\Models;

class User extends Model {

  protected $table = 'users';
  protected $primary = 'id';

  public function __construct()
  {
    parent::__construct();
  }

  public function register($email, $username, $address, $phone, $password, $role='customer') {
    $encryptedPassword = password_hash($password, PASSWORD_BCRYPT);
    try {
      $stm = $this->db->prepare('INSERT INTO users(email, name, address, phone, password, role) VALUES(?, ?, ?, ?, ?, ?)');
      $stm->execute([$email, $username, $address, $phone, $encryptedPassword, $role]);
      return true;
    } catch(\Exception $e) {
      var_dump($e);
      return false;
    }
  }

  public function updateToken($args) {
    $stm = $this->db->prepare('UPDATE users SET auth_token = ? WHERE id = ?');
    $stm->execute($args);
  }
}