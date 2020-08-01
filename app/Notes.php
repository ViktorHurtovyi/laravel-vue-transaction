<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notes extends Model
{
    protected $guarded = [];

    public function noteable()
    {
      return $this->morphTo();
    }
}
