<?php
namespace App\Controllers\Owner;

use Illuminate\Http\Request;
use App\Controllers\BaseController;
use App\Models\Place;
use App\Models\User;
use App\Models\Room;
use Exception;


class RoomControler extends BaseController {
  public function index(User $usr, Place $plc) {
    
    $user = $usr->auth();
    $place = $plc->myPlace();

    return $this->view('seller.room.index', ['user' => $user, 'place' => $place]);
  }

  public function create() {
    return $this->view('seller.room.create');
  }

  public function store(Place $plc, Room $room) {

    $validate  = $this->validate($_POST + $_FILES, [
      
    ]);
    // $room->createRoom();
  }
}