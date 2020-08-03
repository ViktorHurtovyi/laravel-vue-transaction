<?php

namespace Tests\Unit;

use App\Transactions;
use App\User;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class BalanceTest extends TestCase
{
  private $user;
  private $balance;

  public function setUp():void
  {
    parent::setUp();
    DB::beginTransaction();
    $this->user = User::all()->random();
    $transactions = Transactions::where('user_id', $this->user->id)->get();
    $debit = 0;
    $credit = 0;
    foreach ($transactions as $transaction){
      if($transaction->type === 'debit')
        $debit = $debit + $transaction->amount;
      else
        $credit = $credit + $transaction->amount;
    }
    $this->balance = $debit - $credit;

  }

    public function testBasicTest()
    {
        $this->assertTrue($this->user->balance === $this->balance);
    }

  public function tearDown():void
  {
    DB::rollback();
    parent::tearDown();
  }
}
