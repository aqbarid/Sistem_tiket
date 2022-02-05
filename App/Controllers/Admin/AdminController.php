<?php
namespace App\Controllers\Admin;
use Illuminate\Http\Request;
use App\Controllers\BaseController;
use App\Models\Payment;
use App\Models\Place;
use App\Models\Room;
use App\Models\Transaction;
use App\Models\User;

class AdminController extends BaseController {
  
  public function index(User $usr, Room $rm, Transaction $trs) {
    $user = $usr->auth();
    $transactions = $trs->getAllTransactions();
    $totalTransaction = $trs->totalAllTransaction()->count ?? 0;
    $totalWaiting = $trs->countTotalWaiting()->count ?? 0;
    $totalIncome = $trs->countTotalIncome()->income ?? 0;
    $totalRoom = $rm->countAll()->count ?? 0;

    return $this->view('admin.index', [
      'user' => $user,
      'transactions' => $transactions,
      'totalTransaction' => $totalTransaction,
      'totalWaiting' => $totalWaiting,
      'totalIncome' => $totalIncome,
      'totalRoom' => $totalRoom
    ]);
  }

  public function place(Request $request, Place $place) {
    $request = (object) $request->capture()->all();
    $keyword = isset($request->keyword) ? $request->keyword : '';
    $places = $place->getAll($keyword);
    $totalPlace = $place->totalPlace()->count;

    return $this->view('admin.place', ['places' => $places, 'totalPlace' => $totalPlace]);
  }

  public function room(Request $request, Room $rm) {
    $request = (object) $request->capture()->all();
    $keyword = isset($request->keyword) ? $request->keyword : '';

    $totalRoom = $rm->countAll()->count;

    $rooms = $rm->getAllAdminRooms($keyword);
    
    return $this->view('admin.room', ['rooms' => $rooms, 'totalRoom' => $totalRoom]);
  }

  public function transaction(Request $request, Transaction $ts) {
    $request = (object) $request->capture()->all();
    $totalTransaction = $ts->totalAllTransaction()->count;
    $transactions = $ts->getAllTransactions();

    return $this->view('admin.transaction', ['transactions' => $transactions, 'totalTransaction' => $totalTransaction]);
  }

  public function detailTransaction($transactionId, Request $request, Transaction $ts, Payment $py) {
    $payments = $py->whereBy('transaction_id', $transactionId);

    $transaction = $ts->detailTransaction($transactionId);

    dd($transaction);
  }
}

