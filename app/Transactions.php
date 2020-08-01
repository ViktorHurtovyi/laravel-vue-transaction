<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    protected $guarded = [];

    public function notes()
    {
      return $this->morphMany(Notes::class, 'noteable');
    }
}
