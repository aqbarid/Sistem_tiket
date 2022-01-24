<?php

namespace App\Middlewares;

use App\Traits\ResponseTrait;
use App\Traits\SessionTrait;

class Middleware {
  use ResponseTrait, SessionTrait;
}