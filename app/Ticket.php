<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $guarded = ['id']; // With this we make all columns mass assingnable except the ID

    public function comments()
    {
      return $this->morphMany('App\Comment', 'post'); //Here we define that our Ticket model has many comments, that Ticket model owns comments model, this will return all ticket comments
    }
}
