<?php
namespace App\Controllers;
use Illuminate\Http\Request;
use App\Controllers\BaseController;
use App\Models\Place;
use App\Models\User;

class SellerController extends BaseController {

  public function index(Place $place, User $usr) {
    $request  = (object) Request::capture()->all();
    $user = $usr->auth();
    $place = (object) $place->myPlace();
    return $this->view('seller.index', ['place' => $place, 'user' => $user]);
  }
}

