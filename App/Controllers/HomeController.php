<?php
namespace App\Controllers;
use Illuminate\Http\Request;
use App\Controllers\BaseController;

use App\Models\User;

class HomeController extends BaseController {
  public function index(User $usr) {
    $request  = (object) Request::capture()->all();
    
    $user = $usr->auth();

    return $this->view('home', ['user' => $user]);
  }
}

