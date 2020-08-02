<?php


namespace App\services;


use App\Transactions;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class TransactionService
{
  public function get(Request $request): Collection
  {
    return $this->search($request->get('search'));
  }

  public function update($request, $id)
  {
    $transaction = Transactions::findOrFail($id);
    $transaction->update($request->all());
    return $transaction;
  }

  public function create($request)
  {
    return Transactions::create([
      'amount' => $request->get('amount') * 100,
      'type' => $request->get('type'),
      'user_id' => \Auth::user()->id
    ]);
  }

  public function delete($id): string
  {
    $transaction = Transactions::findOrFail($id);
    $transaction->delete();
    return 'success';
  }

  public function search($query = null): Collection
  {
    if (!isset($query)) {
      $transactions = Transactions::orderBy('id', 'desc')->get();
    } elseif (is_numeric($query)) {
      $query = $query * 100;
      $transactions = Transactions::where('amount', '=', "$query")->orderBy('id', 'desc')->get();
    } else {
      $transactions = Transactions::orderBy('id', 'desc')->get()
        ->filter(function ($transaction) use ($query) {
          return $transaction->userName === $query || $transaction->lastNoteTitle === $query;
        });;
    }
    return $transactions;
  }
}
