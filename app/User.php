<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
  use HasApiTokens, Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name', 'email', 'password', 'role'
  ];

  protected $appends = ['balance', 'transactionCount'];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'password', 'remember_token',
  ];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  public function notes()
  {
    return $this->morphMany(Notes::class, 'noteable');
  }

  public function transactions()
  {
    return $this->hasMany(Transactions::class);
  }

  public function getBalanceAttribute()
  {
    return $this->getTransactionBalance('debit') - $this->getTransactionBalance('credit');
  }

  private function getTransactionBalance($type)
  {
    return Transactions::where('user_id', $this->id)->where('transactions.type', '=', $type)->get()->sum('amount');
  }

  public function getTransactionCountAttribute()
  {
    return $this->transactions()->count();
  }
}
