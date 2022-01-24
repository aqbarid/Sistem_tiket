<?php

namespace App\Controllers;
use App\Traits\ViewTrait;
use App\Traits\ResponseTrait;
use App\Traits\SessionTrait;
use App\Traits\ValidatorTrait;
use App\Drivers\Database;

class BaseController extends Database {
  use SessionTrait, ResponseTrait, ValidatorTrait;
  use ViewTrait {
    ViewTrait::__construct as private __bladeConstruct;
  }
  
  public function __construct()
  {
    $this->__bladeConstruct();
    parent::__construct();
  }
}