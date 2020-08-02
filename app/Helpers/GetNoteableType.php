<?php


namespace App\Helpers;


use App\Transactions;
use App\User;

class GetNoteableType
{
  public function getNoteable($type): string
  {
    switch ($type){
      case 'user':
        return User::class;
      case 'transaction':
        return Transactions::class;
    }
  }
}

