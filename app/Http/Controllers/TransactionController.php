<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\services\TransactionService;
use App\Transactions;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;

class TransactionController extends Controller
{
  public function index(Request $request): Collection
  {
    $service = new TransactionService();
    return $service->get($request);
  }

  public function show($id): Object
  {
    return Transactions::with('user')->with('notes')->findOrFail($id);
  }

  public function update(TransactionRequest $request, $id): Collection
  {
    $service = new TransactionService();
    return $service->update($request, $id);
  }

  public function store(TransactionRequest $request)
  {
    $service = new TransactionService();
    return $service->create($request);
  }

  public function destroy($id): string
  {
    $service = new TransactionService();
    return $service->delete($id);
  }
}
