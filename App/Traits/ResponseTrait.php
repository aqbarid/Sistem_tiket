<?php

namespace App\Traits;

trait ResponseTrait {
    public function json($json) {
      header('Content-Type: application/json; charset=utf-8');
      echo json_encode($json);
    }
    public function unauthorize($json = null) {
      header("HTTP/1.1 401 Unauthorized");
    }

    public function notFound($text = 'This page was not found') {
      header("HTTP/1.1 404 NotFound");
      return $this->view('errors.404', ['text' => $text]);
    }
    
    public function redirect($location) {
      header("location: $location", true, 301);
      exit();
    }

    public function flashSession($flashName, $flashValue) {
      $_SESSION[$flashName] = $flashValue;
    }

    public function badRequest($json = null) {
      header("HTTP/1.1 400 Badrequest");
    }
    public static function unprocessableEntity($json = null) {
      header("HTTP/1.1 422 Unprocessable Entity");
    }
    public function end() {
      exit();
    }
}


