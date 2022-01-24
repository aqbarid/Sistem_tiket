<?php

class Config {
  public $database = [
    'host' => '127.0.0.1',
    'port' => 3306,
    'username' => '1ssgg',
    'password' => '9=mk2^qkn#jkMRJnOGKA',
    'database' => '1pdf'
  ];
  public $storage = [
    'pdf' => 'storages/pdf/'
  ];
  public $accessToken = 'c553633345f9be5169f916eb2d057ba5cdf1d7c5d730efd45a5e74093584715b';
  public $appUrl = 'https://pdf.ship-api.comte';

  public function env($val=null) {
    if($val) {
      if(is_array($this->$val)) {
        return (object) $this->$val;
      } 
      return  $this->$val;
    }
    return $this;
  }
}