<?php
namespace App\Controllers;
use Illuminate\Http\Request;
use App\Controllers\BaseController;

class HomeController extends BaseController {
  public function index() {
    $request  = (object) Request::capture()->all();

    return $this->view('home');
  }
}

