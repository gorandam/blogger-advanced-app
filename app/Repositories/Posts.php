<?php

namespace App\Repositories;

use App\Post;

class Posts
{
  public function all()
  {
    // Here is our funciton to extract all posts in our Posts repository
    return Post::all();
  }
}
