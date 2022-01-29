<?php
namespace App\Controllers;
use Illuminate\Http\Request;
use App\Controllers\BaseController;
use App\Models\Place;
use App\Models\Room;
use App\Models\Transaction;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class CheckoutController extends BaseController {
  public function checkout(Request $request, Room $rm, Place $plc, User $usr) {
    
    $request = (object) $request->capture()->all();

    $room = $rm->findById($request->room_id);

    if(!$room) {
      $this->notFound();
    }
    
    $room->image = '/uploads/'.$room->image;

    return $this->view('checkout.checkut', ['room' => $room]);

  }

  public function payment(Request $request, Room $rm, Transaction $trs, User $usr) {
    $request = (object) $request->capture()->all();
    $room = $rm->findById($request->room_id);
    $user = $usr->auth();
    $total = 0;
    $expiredAt = null;
    if($request->type === 'monthly') {
      $total = $room->price_monthly * $request->total;
      $expiredAt = Carbon::now()->addMonths($request->total);
    } elseif($request->type === 'daily') {
      $total = $room->price_daily * $request->total;
      $expiredAt = Carbon::now()->addDays($request->total);
    }

    $newTransaction = $trs->createTransaction([$user->id, $room->id, 'pending', $total, $request->type === 'daily' ? $request->total : 0, $request->type === 'monthly' ? $request->total : 0]);
    $this->flashSession('success', 'Transaction was created');
    $this->redirect('/checkout/payment/'. $newTransaction->id);
  }

  public function tryPayment($id, Transaction $trs, Room $rm) {
    $transaction = $trs->findById($id);
    if(!$transaction) {
      return $this->notFound();
    }
    $room = $rm->findById($transaction->room_id);
    $room->image = '/uploads/'.$room->image;

    return $this->view('checkout.payment', ['transaction' => $transaction, 'room' => $room]);
  }

  public function postPayment(Request $request, Transaction $trs, Payment $pay) {
    $request = (object) $request->capture()->all();
    $validate = $this->validate($_POST + $_FILES, [
      'transaction_id' => 'required',
      'account_name' => 'required',
      'account_number' => 'required',
      'file' => 'required|uploaded_file:0,5M,png,jpeg,jpg'
    ]);

    $currentTransaction = $trs->findIsPending($request->transaction_id);

    if(!$currentTransaction) {
      $this->flashSession('error', 'Transaction Not found');
      return $this->redirect('/checkout/payment/'.$request->transaction_id); 
    }

    if($validate->fail()) {
      $this->flashSession('error', $validate->firstError());
     return $this->redirect('/checkout/payment/'.$request->transaction_id);
    }

    $fileName = $request->file->hashName();
    $fileDir = $_ENV['BASE_PATH'].'/public/uploads/'.$fileName;
    move_uploaded_file($_FILES["file"]["tmp_name"], $fileDir);

    // dd($fileDir);

    // $pay -> 
    // dd($request->file->hashName());

    // Storage::disk('local')->put('uploads/'.$fileName, $request->file, 'public');

    // $pay->createPayment([transaction_id, bank, account_name, account_number, total, file]);

    
  }
}

