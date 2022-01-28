<?php
namespace App\Controllers;
use Illuminate\Http\Request;
use App\Controllers\BaseController;
use App\Models\Place;
use App\Models\Room;
use Illuminate\Support\Collection;

use App\Models\User;

class PlaceController extends BaseController {
  public function detail($placeId, Room $rm, Place $plc, User $usr) {
    $place = $plc->findById($placeId);
    $placeBanner = $plc->getBanners($placeId);
    $user = $usr->auth();
    if(!$place) {
      return $this->notFound();
    }

    $rooms = $rm->whereBy('place_id', $placeId);

    $rooms = new Collection($rooms); 
    $rooms = (object) $rooms->map(function($itm) {
      return (object) array_merge((array)$itm, [
        'image' => '/uploads/'.$itm->image
      ]);
    })->all();
    return $this->view('place.detail', ['place' => $place, 'user' => $user, 'banner' => $placeBanner, 'rooms' => $rooms]); 
  }
}

