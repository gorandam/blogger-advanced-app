<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = ['id'];

    public function posts()
    {
      return $this->belongsToMany(Post::class)->withTimestamps();
    }

    public function getRouteKeyName() // this is name of our route key(wildcard) and by default is id, by id column
    {
        return 'name'; // Here we set it 'name', if we write name in our URI, compose URI with name, it will say 'give me the posts where name = Laravel..'
    }
}
