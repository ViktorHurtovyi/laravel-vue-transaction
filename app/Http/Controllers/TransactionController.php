<?php

namespace App\Http\Controllers;

use App\Transactions;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
  public function index()
  {
    return Transactions::all();
  }

  public function show($id)
  {
    return Transactions::findOrFail($id);
  }

  public function update(Request $request, $id)
  {
    $transaction = Transactions::findOrFail($id);
    $transaction->update($request->all());

    return $transaction;
  }

  public function store(Request $request)
  {
    $transaction = Transactions::create($request->all());
    return $transaction;
  }

  public function destroy($id)
  {
    $transaction = Transactions::findOrFail($id);
    $transaction->delete();
    return '';
  }
}
