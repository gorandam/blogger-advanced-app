<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = ['id'];

    public function ticket() {
      return $this->belongsTo('App\Ticket');
    }

    public function post()
    {
      return $this->morphTo(); // Here we define that our comments belongTo two models which have coments() methods
    }
}
