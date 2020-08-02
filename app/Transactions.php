<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    protected $guarded = [];

    protected $appends = ['userName', 'lastNoteTitle'];

    public function user(){
      return $this->belongsTo(User::class);
    }

    public function getUserNameAttribute(){
      return $this->user?$this->user->name:'';
    }
    public function notes()
    {
      return $this->morphMany(Notes::class, 'noteable');
    }

    public function getLastNoteTitleAttribute(){
      return $this->notes()->count()>0?$this->notes()->latest()->first()->title:'';
    }
}
