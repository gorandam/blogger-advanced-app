<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $guarded = ['id']; // With this we make all columns mass assingnable except the ID

    public function comments() {

      return $this->hasMany('App\Comment', 'post_id');// Here we tell Eloquent that Ticket has many comments and that he can use post_id(foreign key) to find all related comments

    }
}
