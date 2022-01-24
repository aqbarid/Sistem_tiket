<?php
namespace App\Controllers\Owner;
use Illuminate\Http\Request;
use App\Controllers\BaseController;
use App\Models\Place;
use App\Models\User;
use Exception;

class PlaceOwnerController extends BaseController {

  public function index(Place $place, User $usr) {
    $user = $usr->auth();
    $place = (object) $place->myPlace();
    return $this->view('seller.place.index', ['place' => $place, 'user' => $user]);
  }

  public function createOrUpdate(Place $place) {
    $request  = (object) Request::capture()->all();

    $validate  = $this->validate($request, [
      'name' => 'required',
      'address' => 'required', 
      'contact' => 'required',
      'description' => 'required'
    ]);

    if($validate->fail()){
      $this->flashSession('error', $validate->firstError());
      $this->redirect('/seller/place');
    }

    try {
      $place->storeOrUpdate($request->name, $request->address, $request->contact, $request->description);
    } catch(Exception $e) {
      $this->flashSession('error', $e->getMessage());
      $this->redirect('/seller/place');
    }

    $this->flashSession('success', 'Your Place Allready Update');
    $this->redirect('/seller/place');
    
  }
}

