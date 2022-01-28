<?php
namespace App\Controllers\Owner;

use Illuminate\Http\Request;
use App\Controllers\BaseController;
use App\Models\Place;
use App\Models\User;
use App\Models\Room;
use Exception;
use Ramsey\Uuid\Uuid;


class OwnerRoomController extends BaseController {


  public function __construct()
  {
    parent::__construct();
  }

  public function index(User $usr, Place $plc, Room $room) {
    
    $user = $usr->auth();
    $place = $plc->myPlace();
    $room = $room->myRoom();

    return $this->view('seller.room.index', ['user' => $user, 'place' => $place, 'rooms' => $room]);
  }

  public function create() {
    return $this->view('seller.room.create');
  }

  public function store(Place $plc, Room $room) {

    $validate  = $this->validate(($_POST + $_FILES), [
        'image' => 'required|uploaded_file:0,5M,png,jpeg,jpg',
        'name' => 'required',
        'type' => 'required',
        'price_monthly' => 'required',
        'price_daily' => 'required',
        'description' => 'required'
    ]);
    if($validate->fail()) {
      $this->flashSession('error', $validate->firstError());
      $this->redirect('/seller/room/create');
    }

    $fileName = null;

    if(isset($_FILES['image'])) {
      $fileExtension = pathinfo($_FILES['image']['name'])['extension'];
      $fileName = Uuid::uuid4()->toString().'.'.$fileExtension;

      $fileDir = $_ENV['BASE_PATH'].'/public/uploads/'.$fileName;

      move_uploaded_file($_FILES["image"]["tmp_name"], $fileDir);
    }

    //  name, description, type, image, price_monthly, price_daily


    (new Room())->createRoom([$_POST['name'], $_POST['description'], $_POST['type'], $fileName, $_POST['price_monthly'], $_POST['price_daily']]);


    $this->flashSession('success', 'Room created');
    $this->redirect('/seller/room');
  }
}