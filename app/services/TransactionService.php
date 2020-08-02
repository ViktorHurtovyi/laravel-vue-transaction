<?php


namespace App\services;


use App\Transactions;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class TransactionService
{
  public function get(Request $request): Collection
  {
    if(\Auth::user()->role != 'admin')
      return $this->search($request->get('search'))->where('user_id', \Auth::user()->id)->get();
    return $this->search($request->get('search'))->orderBy('id', 'desc')->get();
  }
  public function update($request, $id){
    $transaction = Transactions::findOrFail($id);
    $transaction->update($request->all());
    return $transaction;
  }
  public function create($request){
    return Transactions::create([
      'amount' => $request->get('amount')*100,
      'type' => $request->get('type'),
      'user_id' => \Auth::user()->id
    ]);
  }
  public function delete($id){
    $transaction = Transactions::findOrFail($id);
    $transaction->delete();
    return 'success';
  }
  public function search($query = null)
  {
    $transactions = Transactions::query()
      ->with('user');
      return $query?$transactions->where('amount', '=', "$query"):$transactions;
  }
}
