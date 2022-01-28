<?php
namespace App\Controllers;
use Illuminate\Http\Request;
use App\Controllers\BaseController;
use App\Models\Room;

use App\Models\User;

class HomeController extends BaseController {
  
  public function index(User $usr, Room $rooms) {

    $request  = (object) Request::capture()->all();
    $banner = $rooms->getBanner();
    $latest = $rooms->getAll(isset($request->page) ? $request->page - 1 : 0, isset($request->limit) ? $request->limit  : 100);
    $user = $usr->auth();

    return $this->view('home', ['user' => $user, 'banner' => $banner, 'rooms' => $latest]);
  }
}

