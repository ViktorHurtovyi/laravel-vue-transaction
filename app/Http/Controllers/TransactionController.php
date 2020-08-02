<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\services\TransactionService;
use App\Transactions;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
  public function index(Request $request)
  {
    $service = new TransactionService();
    return $service->get($request);
  }

  public function show($id)
  {
    return Transactions::with('user')->with('notes')->findOrFail($id);
  }

  public function update(TransactionRequest $request, $id)
  {
    $service = new TransactionService();
    return $service->update($request, $id);
  }

  public function store(TransactionRequest $request)
  {
    $service = new TransactionService();
    return $service->create($request);
  }

  public function destroy($id)
  {
    $service = new TransactionService();
    return $service->delete($id);
  }
}
