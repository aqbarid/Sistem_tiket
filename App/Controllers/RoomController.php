<?php
namespace App\Controllers;
use Illuminate\Http\Request;
use App\Controllers\BaseController;
use App\Models\Place;
use App\Models\Room;

use App\Models\User;

class RoomController extends BaseController {
  public function detail($roomId, Room $rm, Place $plc, User $usr) {
    $room = $rm->findById($roomId);
    if(!$room) {
      return $this->notFound();
    }
    $user = $usr->auth();
    $place = $plc->findById($room->place_id);
    $room->image = '/uploads/'.$room->image;
    return $this->view('room.detail', ['room' => $room, 'place' => $place, 'user' => $user]); 
  }
}

