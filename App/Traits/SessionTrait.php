<?php


namespace App\Traits;

trait SessionTrait {
  public function setSession($sessionName, $sessionValue) {
    $_SESSION[$sessionName] = $sessionValue;
  }

  public function getSession($sessionName) {
    return $_SESSION[$sessionName];
  }
}