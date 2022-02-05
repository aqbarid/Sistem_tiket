<?php
namespace App\Controllers\User;
use Illuminate\Http\Request;
use App\Controllers\BaseController;
use App\Models\Room;
use App\Models\Transaction;
use App\Models\User;

class UserMainController extends BaseController {
  
  public function index(User $usr, Room $rooms, Transaction $trs) {
    $user = $usr->auth();
    $totalTransaction = $trs->totalMyTransaction();
    $transactions = $trs->myLastTransaction();

    return $this->view('user.index', ['user' => $user, 'totalTransaction' => $totalTransaction->count, 'transactions' => $transactions]);
  }

  public function setting() {
    return $this->view('user.setting');
  }

  public function transaction(Request $request, Transaction $trs) {
    $request = (object) $request->capture()->all();

    $status = isset($request->type) ? $request->type : null;

    $transactions = [];

    if($status) {
      $transactions = $trs->myTransactionByStatus($status);
    } else {
      $transactions = $trs->myTransaction();
    }

    return $this->view('user.transaction', ['transaction' => $transactions, 'type' => $status ?? 'all']);
  }

  public function pendingTransaction(Transaction $trs) {
    $transactions = $trs->myTransactionByStatus('pending');

    return $this->view('user.transaction', ['transaction' => $transactions]);
  }
}

